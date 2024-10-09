@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <header class="bg-green-700 text-white h-64 flex items-center justify-center">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Discover Cutting-Edge Tech Insights</h1>
            <p class="text-lg">Dive into tutorials, articles, and resources to elevate your programming skills.</p>
        </div>
    </header>

    <div class="grid grid-cols-2 gap-3 mt-3">
        @foreach ($blogs as $blog)
            <a
                href="{{route('blogs.show', $blog)}}" class="turtle-bg-green p-4 pop-card">
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
            </a>
        @endforeach
    </div>

    {{--<div class="flex gap-8 hidden">
        <div class="p-4 flex-1">
            <h2 class="text-2xl font-semibold mb-4">Latest In-Depth Tutorials</h2>
            <div class="flex flex-col gap-3">
                <!-- Loop through latest tutorials -->
                @foreach ($blogs as $blog)

                    <a
                        href="{{route('blogs.index', $blog)}}" class="bg-green-100 p-4 shadow-md rounded-md">
                        <h3 class="text-lg font-semibold">
                            {{ $blog->title }}
                        </h3>
                        <p class="text-green-700">{{ $blog->description }}</p>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Highlighted Tech Posts</h2>
            <div class="flex flex-col gap-3">
                <!-- Loop through featured posts -->
                @foreach ($blogs as $blog)
                    <a href="{{route('blogs.show', $blog)}}">
                        <flux:heading size="lg">{{ $blog->title }}</flux:heading>
                        <flux:subheading>{{ $blog->excerpt }}</flux:subheading>
                    </a>
                @endforeach
            </div>
        </div>
    </div>--}}

@endsection
