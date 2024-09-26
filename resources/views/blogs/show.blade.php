@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <header class="bg-green-700 text-white h-64 flex items-center justify-center">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">{{ $blog->title }}</h1>
            @if ($blog->excerpt)
                <p class="text-lg">{{ $blog->excerpt }}</p>
            @endif
        </div>
    </header>

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
