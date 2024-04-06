<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Edit Blog Post') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        <div class="md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="overflow-hidden shadow sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if(session('error'))
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif
                        <form action="{{ route('blog-posts.update', $blogPost->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-600">Title:</label>
                                <input type="text" name="title" id="title" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" value="{{ $blogPost->title }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="content" class="block mb-2 text-sm font-medium text-gray-600">Content:</label>
                                <textarea name="content" id="content" class="w-full h-32 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" rows="5" required>{{ $blogPost->content }}</textarea>
                            </div>
                            <div>
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Update Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
