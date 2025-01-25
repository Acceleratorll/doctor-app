<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function download($id)
    {

        $record = MedicalRecord::findOrFail($id);

        $folderPath = 'storage/record_files/' . $record->patient_id . '/' . $record->id;

    Log::info("Folder Path: $folderPath");

    // Check if the directory exists in public/storage
    $fullFolderPath = public_path($folderPath);

    if (file_exists($fullFolderPath)) {
        // Get all files in the directory
        $files = glob($fullFolderPath . '/*');

        Log::info("Files: " . implode(', ', $files));

        if (!empty($files)) {
            $zipFileName = 'patient_files.zip';
            $zip = new \ZipArchive();
            // Store the ZIP file in public/storage
            $zipPath = public_path('storage/' . $zipFileName);

            if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
                foreach ($files as $file) {
                    $fileName = pathinfo($file, PATHINFO_BASENAME);
                    $zip->addFile($file, $fileName); // Add files to the ZIP
                }

                $zip->close();

                return response()->download($zipPath)->deleteFileAfterSend();
            }
        }
    }

    return redirect()->back()->with('error', 'No files to download.');
    }

    public function destroy($id)
    {
        //
    }
}
