<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Image Generation') }}
        </h2>
    </x-slot>




    <div x-data="{ isLoading: false, typingText: 'Loading...', texts: ['Generating magic...', 'Summoning creativity...', 'Polishing pixels...', 'Almost there...'] }" x-init="setInterval(() => {
        let index = Math.floor(Math.random() * texts.length);
        typingText = texts[index];
    }, 2000)" class="py-12 dark:bg-gray-900">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Form to input description for image generation -->
                    <form action="{{ route('generate.image') }}" method="POST" class="space-y-4"
                        @submit="isLoading = true">
                        @csrf
                        <textarea name="prompt" id="prompt" placeholder="Describe the image" required
                            class="border p-2 rounded-md w-full resize-y h-40 dark:bg-gray-700 dark:text-gray-200"></textarea>
                        <div class="button-container">
                            <button type="submit" class="generate-button">
                                Generate Image
                            </button>
                        </div>
                    </form>

                    <!-- Show loading screen -->
                    <div x-show="isLoading" x-transition.opacity x-cloak
                        class="fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center">
                        <div class="text-center">
                            <!-- JSON animation (loading spinner) -->
                            <div>
                                <lottie-player src="{{ asset('images/loading.json') }}" background="transparent"
                                    speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
                            </div>

                            <!-- Typing animation -->
                            <div class="mt-4 text-white text-lg font-semibold">
                                <span x-text="typingText"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Generated image section -->
                    @if (isset($imageUrl))
                        <div class="mt-4 space-y-4">
                            <!-- Section Title -->
                            <div class="text-center">
                                <h3 class="font-bold text-2xl text-gray-800 dark:text-gray-200">Generated Image</h3>
                            </div>

                            <!-- Grid Layout for Image and Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Image Container -->
                                <div class="flex justify-center">
                                    <img src="{{ $imageUrl }}" alt="Generated Image"
                                        class="w-full max-w-lg rounded-lg shadow-md">
                                </div>

                                <!-- Image Details -->
                                <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md space-y-4">
                                    <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Image Details
                                    </h3>
                                    <p><strong>Prompt:</strong> {{ $prompt }}</p>
                                    <p><strong>Date:</strong> {{ now()->format('F j, Y, g:i a') }}</p>
                                    <p><strong>File Size:</strong> {{ $fileSize }} KB</p>
                                    <p><strong>Resolution:</strong> {{ $resolution }}</p>

                                    <!-- Buttons Section -->
                                    <div class="flex flex-col space-y-4">
                                        <!-- Save to Gallery Button -->
                                        <form action="{{ route('save.image') }}" method="POST" class="w-full">
                                            @csrf
                                            <input type="hidden" name="image_url" value="{{ $imageUrl }}">
                                            <input type="hidden" name="prompt" value="{{ $prompt }}">
                                            <button type="submit"
                                                class="bg-green-500 text-white p-3 rounded-md w-full flex items-center justify-center space-x-2 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32px"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff">

                                                    <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round" />

                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M17 17H17.01M17.4 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H6.6M12 15V4M12 15L9 12M12 15L15 12"
                                                            stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </g>

                                                </svg>
                                                <span>Save to Gallery</span>
                                            </button>
                                        </form>

                                        <!-- Download Image Button -->
                                        <a href="{{ $imageUrl }}" download="generated_image.png"
                                            class="bg-gray-500 text-white p-3 rounded-md w-full flex items-center justify-center space-x-2 hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="30px"
                                                viewBox="0 0 32 32">
                                                <path
                                                    d="M26 0H6a6 6 0 0 0-6 6v20a6 6 0 0 0 6 6h20a6 6 0 0 0 6-6V6a6 6 0 0 0-6-6zm-6 2v3a1 1 0 1 0 2 0V2h1v7H9V2zm10 24a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V6a4 4 0 0 1 4-4h1v8a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2h1a4 4 0 0 1 4 4zM24 14H8a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V15a1 1 0 0 0-1-1zm-1 12H9V16h14zM12 20h8a1 1 0 0 0 0-2h-8a1 1 0 0 0 0 2zM12 24h8a1 1 0 0 0 0-2h-8a1 1 0 0 0 0 2z" />
                                            </svg>
                                            <span>Download Image</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif(session('success'))
                        <div x-data="{
                            open: true,
                            triggerConfetti: false,
                            closeModal() {
                                this.open = false;
                                this.triggerConfetti = false;
                            },
                            startConfetti() {
                                this.triggerConfetti = true;
                                confetti({
                                    particleCount: 150,
                                    spread: 70,
                                    origin: { x: 0.5, y: 0.5 },
                                    colors: ['#ff0', '#0f0', '#f00', '#00f']
                                });
                            }
                        }" x-init="startConfetti()" @click.away="closeModal()" x-cloak>
                            <!-- Modal Background with Transition -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

                                <!-- Modal Content -->
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-96">
                                    <h2 class="text-xl font-semibold text-center mb-4 text-gray-800 dark:text-gray-200">
                                        Success!</h2>
                                    <p class="text-center mb-6 text-gray-600 dark:text-gray-300">
                                        Your image has been successfully added to your gallery! 🎉
                                    </p>
                                    <div class="flex justify-around">
                                        <!-- Button to View Gallery -->
                                        <a href="{{ route('user.gallery') }}"
                                            class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-200">
                                            Show My Gallery
                                        </a>
                                        <!-- Button to Generate New Image -->
                                        <button @click="closeModal"
                                            class="bg-gray-500 text-white p-2 rounded-md hover:bg-gray-600 transition duration-200">
                                            Generate New Image
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Confetti Effect -->
                            <div x-show="triggerConfetti" class="absolute inset-0 pointer-events-none z-40">
                                <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
                            </div>
                        </div>
                    @elseif(session('error'))
                        <div class="mt-4 text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script>
        const prompts = [
            "Astronaut Riding A Horse",
            "Futuristic City at Sunset",
            "A Dragon Flying Over Mountains",
            "Robot Playing Chess with Human",
            "Mysterious Forest with Glowing Lights",
            "Underwater City with Floating Islands",
            "Cyberpunk Street with Neon Lights",
            "A Cat in Space Suit",
            "Pirate Ship Sailing Through a Storm",
            "Fantasy Castle on a Cloud"
        ];

        let currentPromptIndex = 0;
        const textarea = document.getElementById('prompt');

        function typePlaceholder(text, index = 0) {
            // Set the placeholder to the text up to the current index
            textarea.placeholder = text.slice(0, index);

            // If there are more characters to type, call this function recursively
            if (index < text.length) {
                setTimeout(() => typePlaceholder(text, index + 1), 100); // Adjust the speed here
            } else {
                // Once typing is complete, change to the next prompt
                setTimeout(() => changePlaceholder(), 1000); // Wait briefly before switching to next
            }
        }

        function changePlaceholder() {
            const currentPrompt = prompts[currentPromptIndex];
            currentPromptIndex = (currentPromptIndex + 1) % prompts.length;

            // Start typing the next placeholder text
            typePlaceholder(currentPrompt);
        }

        // Start typing the first placeholder immediately
        typePlaceholder(prompts[currentPromptIndex]);
    </script>
</x-app-layout>
