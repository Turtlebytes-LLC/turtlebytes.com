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

    <flux:header class="text-2xl font-semibold my-4 lg:px-0">Posts in this Blog</flux:header>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Loop through blog posts -->
        @foreach ($blog->posts as $post)
            <a href="{{ route('blogs.post.show', [$blog, $post]) }}" class="turtle-bg-green p-4 pop-card">
                <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                <p class="text-green-700">{{ $post->excerpt }}</p>
            </a>
        @endforeach
    </div>

@endsection
