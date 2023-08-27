@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <header class="bg-blue-800 text-white h-64 flex items-center justify-center">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to Your Tech Blog</h1>
            <p class="text-lg">Exploring the latest in tech programming and development.</p>
        </div>
    </header>

    <div class="content-container">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="p-4">
                <h2 class="text-2xl font-semibold mb-4">Latest Tutorials</h2>
                <div class="bg-white p-4 shadow-md rounded-md">
                    <!-- Loop through latest tutorials -->
                    @foreach ($blogs as $tutorial)
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">{{ $tutorial->title }}</h3>
                            <p class="text-gray-600">{{ $tutorial->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="p-4">
                <h2 class="text-2xl font-semibold mb-4">Featured Posts</h2>
                <div class="bg-white p-4 shadow-md rounded-md">
                    <!-- Loop through featured posts -->
                    @foreach ($blogs as $post)
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                            <p class="text-gray-600">{{ $post->excerpt }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
