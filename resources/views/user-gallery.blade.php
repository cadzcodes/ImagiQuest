<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Gallery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($images->isEmpty())
                <!-- Lottie Animation and Friendly Message -->
                <div class="flex justify-center items-center flex-col text-center space-y-4">
                    <div class="w-64 h-64">
                        <!-- Lottie Animation (empty gallery) -->
                      <lottie-player src="{{ asset('images/missing.json') }}"
                                       background="transparent" speed="1" loop autoplay>
                        </lottie-player>
                    </div>
                    <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        Seems empty here, just add some images! 🎉
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        It looks like you don't have any images in your gallery yet. Why not upload some to make it shine? 😊
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6 px-4 sm:px-0 md:grid-cols-3">
                    @foreach ($images as $image)
                        <div
                            class="relative overflow-hidden rounded-lg border border-gray-300 shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl group dark:border-gray-600 dark:bg-gray-800 dark:shadow-md">
                            <img src="{{ $image->image_url }}" alt="Generated Image"
                                 class="w-full h-auto transition-transform duration-300 group-hover:scale-105">

                            <div
                                class="absolute bottom-0 left-0 right-0 bg-white dark:bg-gray-800 p-4 flex justify-between items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <!-- Download Button -->
                                <a href="{{ $image->image_url }}" download="generated_image.png"
                                   class="p-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="24px" height="24px"
                                         viewBox="0 0 24 24" stroke="#ffffff">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 4v12m0 0l-4-4m4 4l4-4m4 8H4" />
                                    </svg>
                                </a>

                                <!-- Delete Button with Alpine.js -->
                                <div x-data="{ open: false }">
                                    <button @click="open = true"
                                            class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="16px" height="16px"
                                             viewBox="0 0 24 24" stroke="#ffffff">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <!-- Confirmation Modal -->
                                    <div x-show="open" x-transition
                                         class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-50">
                                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-80">
                                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Are you
                                                sure?</h3>
                                            <p class="text-gray-700 dark:text-gray-300 mb-4">Oops! Are you sure you want to
                                                delete this image from your gallery? It's totally okay if you change your
                                                mind, we won't be mad! 😊</p>
                                            <div class="flex justify-between">
                                                <button @click="open = false"
                                                        class="bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white p-2 rounded-md">Cancel</button>
                                                <form action="{{ route('delete.image', $image->id) }}" method="POST"
                                                      class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600">Yes,
                                                        delete it!</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4">
                                <p
                                    class="text-gray-800 dark:text-white font-semibold bg-white dark:bg-gray-800 p-2 rounded-lg">
                                    {{ $image->prompt }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
