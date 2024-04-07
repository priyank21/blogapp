<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create Blog Post') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        <div class="md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="overflow-hidden shadow sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('blog-posts.store') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="mb-4">
                                    <div class="font-medium text-red-600">
                                        {{ __('Whoops! Something went wrong.') }}
                                    </div>

                                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Success message -->
                            @if (session('success'))
                                <div class="mb-4 text-green-600">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-4">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-600">Title:</label>
                                <input type="text" name="title" id="title" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required>
                            </div>
                            <div class="mb-4">
                                <label for="content" class="block mb-2 text-sm font-medium text-gray-600">Content:</label>
                                <textarea name="content" id="content" class="w-full h-32 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required></textarea>
                            </div>
                            <div>
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Create Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
