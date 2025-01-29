<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\AiDiagnose;
use App\Models\User;
use App\Services\OllamaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Cloudstudio\Ollama\Facades\Ollama;
use Illuminate\Console\BufferedConsoleOutput;
use Illuminate\Support\Str;

class AiDiagnoseController extends Controller
{
    protected OllamaService $service;

    public function __construct(OllamaService $service)
    {
        $this->service = $service;
        $this->middleware('throttle:10,1')->only('generate'); // Rate limiting
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:120',
            'symptoms' => 'required|min:10|max:1000',
            'current_medications' => 'nullable|max:500',
            'tone' => 'required',
        ], [
            'symptoms.required' => 'Deskripsi gejala wajib diisi',
            'tone.in' => 'Pilihan nada respons tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $aiDiagnose = AiDiagnose::create([
                'user_id' => $request->user_id,
                'title' => strip_tags($request->title),
                'symptoms' => $request->symptoms,
                'current_medications' => $request->current_medications,
                'tone' => $request->tone,
            ]);

            // Audit log
            Log::channel('medical')->info('Diagnosis created', [
                'id' => $aiDiagnose->id,
                'ip' => $request->ip()
            ]);

            return redirect()->route('home.ai')
                ->with('ai_diagnose', $aiDiagnose) // Keep session key consistent
                ->with('success', 'Konsultasi awal berhasil dibuat');
        } catch (\Exception $e) {
            Log::channel('medical')->error('Diagnosis creation failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal membuat konsultasi. Silakan coba lagi.')
                ->withInput();
        }
    }

    public function index(Request $request)
    {
        $tones = [
            "Profesional" => "👨⚕️",
            "Empatik" => "🤝",
            "Sederhana" => "📖",
            "Bilingual" => "🌏",
            "Anak-anak" => "🚼",
            "lansia" => "🧓"
        ];

        // Get diagnosis from session or create empty state
        $diagnosis = $request->session()->get('ai_diagnose');
        $users = User::all(); // Get all users

        return view('welcome', [
            'diagnosis' => $diagnosis,
            'diagnosis_id' => optional($diagnosis)->id,
            'tones' => $tones,
            'selected_tone' => $diagnosis ? $diagnosis->tone : 'Professional',
            'selected_user' => optional($users)->user_id ?? null,
            'users' => $users
        ]);
    }

    public function generate(Request $request, $id)
    {
        try {
            $diagnosis = AiDiagnose::findOrFail($id);
            $this->authorize('view', $diagnosis);

            return response()->stream(function () use ($diagnosis) {
                $messages = $diagnosis->getPromptMessages();
                $fullResponse = '';
                $currentSection = '';

                $this->service->streamResponse($messages, function ($chunk) use ($diagnosis, &$fullResponse, &$currentSection) {
                    $text = $chunk->message->content ?? '';
                    $fullResponse .= $text;

                    // Section detection
                    if (Str::startsWith($text, '### ')) {
                        $currentSection = Str::after($text, '### ');
                        $this->sendEvent('section', ['title' => $currentSection]);
                        return;
                    }

                    // Send real-time update
                    $this->sendEvent('update', [
                        'text' => $text,
                        'section' => $currentSection ?: 'general'
                    ]);

                    // Finalize when done
                    if ($chunk->done) {
                        $diagnosis->update([
                            'content' => $fullResponse,
                            'generated_at' => now()
                        ]);
                        $this->sendEvent('complete', ['status' => 'done']);
                    }
                });
            }, 200, $this->getStreamHeaders());
        } catch (\Exception $e) {
            Log::channel('medical')->error('Generation error: ' . $e->getMessage());
            return response()->json(['error' => 'Consultation failed'], 500);
        }
    }

    private function finalizeDiagnosis(AiDiagnose $diagnosis, array $result)
    {
        try {
            $diagnosis->update([
                'content' => json_encode($result['sections'], JSON_UNESCAPED_UNICODE),
                'generated_at' => Carbon::now(),
            ]);

            $this->send('update', '<END_STREAMING_SSE>');

            Log::channel('medical')->info('Diagnosis completed', [
                'id' => $diagnosis->id,
                'sections' => array_keys($result['sections'])
            ]);
        } catch (\Exception $e) {
            Log::channel('medical')->error('Diagnosis finalization failed: ' . $e->getMessage());
            $this->send('error', json_encode([
                'error' => 'Gagal menyimpan hasil diagnosis'
            ]));
        }
    }

    public function getContent(Request $request, $id)
    {
        $diagnosis = AiDiagnose::findOrFail($id);
        return response()->json([
            'content' => $diagnosis->content
        ]);
    }

    private function send($event, $data)
    {
        echo "event: {$event}\n";
        echo "data: {$data}\n\n";
        ob_flush();
        flush();
    }

    private function getStreamHeaders()
    {
        return [
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
            'Cache-Control' => 'no-cache',
            'Content-Security-Policy' => "default-src 'self'",
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
        ];
    }

    public function consult(Request $request)
    {
        $messages = [
            'role' => 'user',
            'content' => $request->symptoms
        ];

        try {
            $response = $this->service->streamResponse($messages);
            $output = new BufferedConsoleOutput();
            $responses = Ollama::processStream($response->getBody(), function ($data) use ($output) {
                $output->write($data['response']);
            });

            $output->write("\n");
            $complete = implode('', array_column($responses, 'response'));
            $output->write("<info>$complete</info>");
            return response()->json(['content' => $complete]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to get AI response'], 500);
        }
    }

    #i want this function can stream the response to welcome.blade.php. AI!
    public function streamConsult(Request $request)
    {
        $messages = [
            'role' => 'user',
            'content' => $request->symptoms
        ];

        try {
            $response = $this->service->streamResponse($messages);
            $output = new BufferedConsoleOutput();
            $responses = Ollama::processStream($response->getBody(), function ($data) use ($output) {
                $output->write($data['response']);
            });

            $output->write("\n");
            $complete = implode('', array_column($responses, 'response'));
            $output->write("<info>$complete</info>");
            return response()->json(['content' => $complete]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to get AI response'], 500);
        }
    }

    private function getAIResponse(array $prompt)
    {
        // Implement actual AI API call here
        // Example using OpenAI:
        $client = new \OpenAI\Client(env('OPENAI_API_KEY'));

        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $prompt,
            'temperature' => 0.7,
        ]);

        return $response->choices[0]->message->content;
    }
}
