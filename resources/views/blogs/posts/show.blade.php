@extends('layouts.app')

@section('content')
    <div class="p-4">
        <article class="bg-white p-6 shadow-md rounded-md">
            <h1 class="text-3xl font-semibold mb-4">{{ $post->title }}</h1>
            <div class="text-gray-600 mb-4">{{ $post->created_at->format('F j, Y') }}</div>
            <div class="prose">
                {!! \Illuminate\Mail\Markdown::parse($post->body) !!}
            </div>
            <div class="mt-4 flex items-center">
                <img src="{{ $post->author->avatar }}" alt="Author Avatar" class="w-8 h-8 rounded-full mr-2">
                <span class="text-gray-600">{{ $post->author->name }}</span>
            </div>
        </article>

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
    </div>
@endsection
