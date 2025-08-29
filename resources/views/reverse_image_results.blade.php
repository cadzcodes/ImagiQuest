<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Reverse Image Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200">Reverse Image Search Results</h2>
                @if (isset($results['data']) && is_array($results['data']) && !empty($results['data']))
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($results['data'] as $result)
                            <div
                                class="border border-gray-300 dark:border-gray-600 p-4 rounded-lg shadow-md hover:shadow-xl transform hover:scale-105 transition duration-300">
                                @if ($result['image_url'])
                                    <a href="{{ $result['page_url'] ?? $result['image_url'] }}" target="_blank">
                                        <img src="{{ $result['image_url'] }}" alt="Preview"
                                            class="w-full h-auto object-cover rounded-lg transition-transform duration-300 hover:scale-110">
                                    </a>
                                @else
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 break-all">
                                        <a href="{{ $result['page_url'] }}" target="_blank"
                                            class="hover:underline text-blue-600 dark:text-blue-400">
                                            Visit Page
                                        </a>
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No matching images were found. Please try another image.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
