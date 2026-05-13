@extends('layouts.app')

@section('content')
<div class="flex flex-col h-screen bg-gray-100">
    <!-- Chat Header -->
    <div class="bg-white border-b p-4 shadow-sm">
        <h2 class="text-xl font-semibold text-gray-800">Ollama AI Assistant</h2>
    </div>

    <!-- Message Area -->
    <div id="chat-window" class="flex-1 overflow-y-auto p-4 space-y-4">
        <!-- AI Greeting -->
        <div class="flex items-start">
            <div class="bg-white border text-gray-800 p-3 rounded-lg shadow-sm max-w-2xl">
                <p class="text-sm">Hello! How can I help you with the E-commerce module today?</p>
            </div>
        </div>
    </div>

    <!-- Input Area -->
    <div class="bg-white border-t p-4">
        <form id="chat-form" class="max-w-4xl mx-auto flex gap-2">
            <textarea
                id="user-input"
                rows="1"
                class="flex-1 border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                placeholder="Type your message..."
            ></textarea>
            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow-md flex items-center gap-2"
            >
                <span>Send</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');
    const chatWindow = document.getElementById('chat-window');

    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = userInput.value.trim();
        if (!message) return;

        // Append User Message
        appendMessage('user', message);
        userInput.value = '';

        try {
            // Logic to call your Laravel API that connects to Ollama
            const response = await fetch('/chat/stream', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });

            // Handle Parsing Ollama Response
            const data = await response.json();

            console.log('Ollama Response:', data.response);

            appendMessage('ai', data.response);
        } catch (error) {
            appendMessage('ai', 'Error: Could not connect to Ollama.');
        }
    });

    function appendMessage(role, text) {
        const wrapper = document.createElement('div');
        wrapper.className = role === 'user' ? 'flex justify-end' : 'flex justify-start';

        const bubble = document.createElement('div');
        bubble.className = role === 'user'
            ? 'bg-blue-600 text-white p-3 rounded-lg shadow-md max-w-2xl'
            : 'bg-white border text-gray-800 p-3 rounded-lg shadow-sm max-w-2xl';

        bubble.innerHTML = `<p class="text-sm">${text}</p>`;
        wrapper.appendChild(bubble);
        chatWindow.appendChild(wrapper);

        // Auto-scroll
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }
</script>
@endsection
