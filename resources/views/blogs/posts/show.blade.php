@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <header class="bg-green-700 text-white h-64 flex items-center justify-center">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>
            @if ($post->excerpt)
                <p class="text-lg">{{ $post->excerpt }}</p>
            @endif
        </div>
    </header>

    <div class="content-container bg-green-50 py-8">
        <article class="bg-white p-6 shadow-md rounded-md">
            <h1 class="text-3xl font-semibold mb-4">{{ $post->title }}</h1>
            <div class="text-gray-600 mb-4">{{ $post->created_at->format('F j, Y') }}</div>
            <div class="prose">
                {!! \Illuminate\Mail\Markdown::parse($post->body) !!}
            </div>
        </article>
    </div>

    <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4">Comments</h2>
        <div class="space-y-4">
            <!-- Loop through comments -->
            @forelse($post->comments as $comment)
                <div class="bg-gray-100 p-4 shadow-md rounded-md">
                    <p class="text-gray-600">{{ $comment->content }}</p>
                    <div class="mt-2 text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
                </div>
            @empty
                <p>No comments yet.</p>
            @endforelse
        </div>
    </div>

@endsection
