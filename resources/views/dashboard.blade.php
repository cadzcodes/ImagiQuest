<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Box 1: AI Image Generation -->
                <div class="border p-6 rounded-lg text-center bg-white dark:bg-gray-800 hover-trigger"
                    data-route="{{ route('image.generation') }}">
                    <div class="flex justify-center items-center h-32 mb-4">
                        <img src="{{ asset('images/image-gen.png') }}" alt="AI Image Generation"
                            class="hover-gif max-w-xs max-h-32 rounded-lg"
                            data-gif="{{ asset('images/image-gen.gif') }}" 
                            data-png="{{ asset('images/image-gen.png') }}" />
                    </div>
                    <p class="font-semibold text-gray-900 dark:text-gray-100">AI Image Generation</p>
                </div>


                <!-- Box 3: Saved Images -->
                <div class="border p-6 rounded-lg text-center bg-white dark:bg-gray-800 hover-trigger"
                    data-route="{{ route('user.gallery') }}">
                    <div class="flex justify-center items-center h-32 mb-4">
                        <img src="{{ asset('images/album.png') }}" alt="Saved Images"
                            class="hover-gif max-w-xs max-h-32 rounded-lg"
                            data-gif="{{ asset('images/album.gif') }}" 
                            data-png="{{ asset('images/album.png') }}" />
                    </div>
                    <p class="font-semibold text-gray-900 dark:text-gray-100">Saved Images</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
