<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Doctor</title>
    <link href="https:
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg">
            <div class="p-4 border-b">
                <h2 class="text-xl font-bold text-gray-800">AI Doctor</h2>
                <p class="text-sm text-gray-600">Your symptoms will be analyzed based on Indonesian medical guidelines</p>
            </div>

            <!-- Chat Container -->
            <div id="chat-container" class="h-96 overflow-y-auto p-4 space-y-4">
                <!-- Loading Indicator -->
                <div id="loading" class="hidden text-center text-blue-500">
                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500 mx-auto"></div>
                </div>
                
                <!-- AI Responses -->
                <div id="ai-responses"></div>
            </div>

            <!-- Input Form -->
            <div class="p-4 border-t">
                <form id="consultation-form" class="flex space-x-4">
                    <input type="text" 
                           id="symptoms-input"
                           placeholder="Describe your symptoms..."
                           class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    <button type="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('consultation-form');
            const chatContainer = document.getElementById('chat-container');
            const loadingIndicator = document.getElementById('loading');
            const symptomsInput = document.getElementById('symptoms-input');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const symptoms = symptomsInput.value.trim();
                
                if (!symptoms) return;

                form.querySelector('button').disabled = true;
                
                try {
                    loadingIndicator.classList.remove('hidden');

                    const userMessage = document.createElement('div');
                    userMessage.className = 'user-message bg-gray-100 p-4 rounded-lg ml-4';
                    userMessage.innerHTML = `
                        <div class="font-medium text-gray-600 mb-2">You</div>
                        <p>${symptoms}</p>
                    `;
                    chatContainer.appendChild(userMessage);

                    const response = await fetch('/consult', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            //Error: TypeError: Cannot read properties of null (reading 'content'). Fix this. AI!
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ symptoms: symptoms })
                    });

                    if (!response.ok) throw new Error('Failed to get response');

                    const aiMessage = document.createElement('div');
                    aiMessage.className = 'ai-message bg-blue-50 p-4 rounded-lg';
                    aiMessage.innerHTML = `
                        <div class="font-medium text-blue-600 mb-2">AI Doctor</div>
                        <p class="response-content"></p>
                    `;
                    chatContainer.appendChild(aiMessage);

                    const reader = response.body.getReader();
                    const decoder = new TextDecoder();
                    let responseText = '';

                    while (true) {
                        const { done, value } = await reader.read();
                        if (done) break;
                        
                        const chunk = decoder.decode(value, { stream: true });
                        responseText += chunk;
                        
                        aiMessage.querySelector('.response-content').textContent = responseText;
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }

                } catch (error) {
                    console.error('Error:', error);
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'text-red-500 p-2';
                    errorMessage.textContent = 'Failed to get AI response';
                    chatContainer.appendChild(errorMessage);
                } finally {
                    loadingIndicator.classList.add('hidden');
                    form.querySelector('button').disabled = false;
                    symptomsInput.value = '';
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            });
        });
    </script>
</body>
</html>