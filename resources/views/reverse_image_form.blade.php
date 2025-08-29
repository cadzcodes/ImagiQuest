<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Reverse Image Search') }}
        </h2>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form action="{{ route('reverse.search') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload
                            Image</label>
                        <div class="mt-1 relative">
                            <div id="drag-drop-area"
                                class="border-2 border-dashed border-gray-300 dark:border-gray-600 p-8 text-center cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 transition-all"
                                ondrop="handleDrop(event)" ondragover="allowDrop(event)" onclick="triggerFileInput()"
                                style="min-height: 250px; display: flex; justify-content: center; align-items: center;">
                                <div id="icon-text" class="block text-center flex flex-col justify-center items-center">
                                    <div id="lottie-animation" class="mb-2" style="width: 300px; height: 300px;">
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 text-lg">
                                        Ready to find something? Just drag your image here, or click to browse for your
                                        file!
                                    </p>
                                </div>

                                <!-- Image Preview Section -->
                                <div id="image-preview" class="hidden relative w-fit mx-auto">
                                    <img id="preview-img" src="" alt="Image preview"
                                        class="rounded-lg shadow-md"
                                        style="max-height: 300px; max-width: 100%; object-fit: contain; display: block;">

                                    <button type="button" onclick="removeImage(event)"
                                        class="absolute top-2 right-2 text-white bg-red-600 hover:bg-red-800 p-2 rounded-full">
                                        &times;
                                    </button>
                                </div>
                            </div>

                            <input type="file" name="image" id="image" class="hidden"
                                onchange="showPreview(event)">
                        </div>
                    </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline dark:bg-blue-600 dark:hover:bg-blue-800">
                Submit
            </button>
            </form>
        </div>
    </div>

    <!-- New Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="text-center text-white">
            <div id="loading-lottie" class="mb-4" style="width: 100px; height: 100px;"></div>
            <p class="text-xl">Searching for similar images...</p>
            <p class="text-lg mt-2">Please wait while we find the perfect match for you!</p>
        </div>
    </div>

    <script>
        // Allow the drop event to happen
        function allowDrop(event) {
            event.preventDefault(); // Prevent the default behavior (Prevent file from opening)
        }

        // Handle the image drop event
        function handleDrop(event) {
            event.preventDefault();

            let files = event.dataTransfer.files;
            if (files.length > 0) {
                let input = document.getElementById("image");
                input.files = files; // Set the dropped files to the file input
                showPreview(event); // Call the preview function
            }
        }

        // Show the image preview after file selection or drop
        function showPreview(event) {
            const fileInput = event.target.files ? event.target : document.getElementById("image");
            const file = fileInput.files[0]; // Grab the first file (if available)

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById("preview-img");
                    const imagePreview = document.getElementById("image-preview");
                    const iconText = document.getElementById("icon-text");

                    previewImg.src = e.target.result;
                    iconText.classList.add("hidden"); // Hide the icon and text
                    imagePreview.classList.remove("hidden"); // Show the image preview
                };
                reader.readAsDataURL(file);
            }
        }

        // Remove the image and reset the state
        function removeImage(event) {
            event.stopPropagation(); // Prevent triggering the parent click event
            const input = document.getElementById("image");
            const imagePreview = document.getElementById("image-preview");
            const iconText = document.getElementById("icon-text");

            input.value = ""; // Clear file input
            imagePreview.classList.add("hidden"); // Hide the image preview
            iconText.classList.remove("hidden"); // Show the icon and text again
        }

        // Trigger click when drag-and-drop area is clicked
        function triggerFileInput() {
            document.getElementById('image').click();
        }

        // Trigger drag-and-drop styling and reset state on drag events
        const dragDropArea = document.getElementById('drag-drop-area');
        dragDropArea.addEventListener('dragenter', function(event) {
            dragDropArea.classList.add('bg-gray-200', 'dark:bg-gray-700');
        });

        dragDropArea.addEventListener('dragleave', function(event) {
            dragDropArea.classList.remove('bg-gray-200', 'dark:bg-gray-700');
        });

        // Load the initial Lottie animation (existing one)
        var initialAnimation = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('images/add.json') }}'
        });

        // Function to show loading overlay and Lottie animation
        function showLoadingOverlay() {
            // Make the page unscrollable and add a dark overlay
            document.body.style.overflow = "hidden";
            document.getElementById("loading-overlay").classList.remove("hidden");

            // Load the new Lottie animation
            var loadingAnimation = lottie.loadAnimation({
                container: document.getElementById('loading-lottie'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '{{ asset('images/loading.json') }}' // Path to the new loading animation
            });
        }

        // Show loading overlay when form is submitted
        document.querySelector("form").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately
            showLoadingOverlay(); // Display the loading animation

            // Now submit the form after the loading is displayed
            setTimeout(function() {
                document.querySelector("form").submit();
            }, 2000); // Simulate delay before submitting, adjust based on actual search time
        });
    </script>

</x-app-layout>
