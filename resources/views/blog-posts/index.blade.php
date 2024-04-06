<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
            {{ __('All Blog Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <div class="bg-white shadow-lg rounded-lg p-6" style="background-color: #22274d;">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-black-400 dark:text-black-400">Recent Blog Posts</h3>
                        @auth
                            <a href="{{ route('blog-posts.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Create New Post</a>
                        @endauth
                    </div>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($blogPosts as $post)
                            <div class="py-4">
                                <a href="{{ route('blog-posts.show', $post->id) }}" class="block hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg p-4">
                                    <h4 class="text-lg font-semibold text-black-800 dark:text-black-200">{{ ucwords($post->title) }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $post->created_at->format('M d, Y') }}</p>
                                </a>
                            </div>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400 py-4">No blog posts found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
