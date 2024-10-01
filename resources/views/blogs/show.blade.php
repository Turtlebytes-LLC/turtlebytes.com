@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <flux:card>
        <flux:heading size="lg">{{ $blog->title }}</flux:heading>
        <flux:subheading class="flex gap-3">
            <div>
                Author:
                {{ $blog->author->name }}
            </div>
            <div>
                Published:
                {{ $blog->created_at->diffForHumans() }}
            </div>
        </flux:subheading>
        <flux:description>{{ $blog->description }}</flux:description>
    </flux:card>

    <div class="content-container bg-green-50 py-8">
        <div class="container mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Posts in this Blog</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Loop through blog posts -->
                @foreach ($blog->posts as $post)
                    <a href="{{ route('blogs.post.show', [$blog, $post]) }}" class="bg-white p-4 shadow-md rounded-md hover:bg-green-100 transition duration-300">
                        <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                        <p class="text-green-700">{{ $post->excerpt }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

@endsection
