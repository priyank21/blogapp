<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ $blogPost->title }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-lg text-black-800 dark:text-black-800">{{ ucwords($blogPost->title) }}</p>
                        <p class="text-lg text-black-800 dark:text-black-400">{{ $blogPost->content }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <p class="text-black dark:text-gray-400">Created by: {{ $blogPost->user->name }}</p>
                        @if(auth()->id() === $blogPost->user_id)
                            <div class="flex space-x-4">
                                <a href="{{ route('blog-posts.edit', $blogPost->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</a>
                                <form action="{{ route('blog-posts.destroy', $blogPost->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                </form>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
