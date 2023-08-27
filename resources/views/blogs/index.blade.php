@extends('layouts.app')

@section('content')
    <div class="p-4">
        <h2 class="text-2xl font-semibold mb-4">Blog</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Loop through blog posts -->
            @foreach ($blogs as $blog)
                <div class="bg-white p-4 shadow-md rounded-md">
                    <h3 class="text-lg font-semibold">{{ $blog->title }}</h3>
                    <p class="text-gray-600">{{ $blog->description }}</p>
                    <div class="mt-4 flex items-center">
                        <img src="{{ $blog->author->avatar }}" alt="Author Avatar" class="w-8 h-8 rounded-full mr-2">
                        <span class="text-gray-600">{{ $blog->author->name }}</span>
                    </div>

                    <!-- Last 10 posts -->
                    <div class="mt-4">
                        <h4 class="text-md font-semibold mb-2">Recent Posts</h4>
                        <ul class="list-inside text-gray-600 list-unstyled">
                            @forelse($blog->posts as $recentPost)
                                <li class="list-group-item-action bg-gray-300 hover:bg-custom-400/10 my-2 p-3">
                                    <a href="{{ route('blogs.post.show', [$blog, $recentPost]) }}">{{ $recentPost->title }}</a>
                                </li>
                            @empty
                                <li>No posts yet.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
