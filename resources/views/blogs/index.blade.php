@extends('layouts.app')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 space-x-4 space-y-6">
            @foreach ($blogs as $blog)
                <flux:card class="bg-green-100 pop-card">
                    <a href="{{route('blogs.show', $blog)}}" class="block decoration-0">
                        <flux:heading level="3" class="text-xl font-bold text-gray-800 mb-2">{{ $blog->title }}</flux:heading>
                        <flux:text class="text-gray-700 mb-4">{{ \Illuminate\Support\Str::limit($blog->description) }}</flux:text>
                        <div class="items-center mb-4 space-x-3">
                        </div>
                    </a>

                    <div class="border-t pt-4">
                        <flux:heading level="4" class="text-lg font-semibold mb-3">Recent Posts</flux:heading>
                        <div class="space-y-2">
                            @forelse($blog->posts as $recentPost)
                                <div class="bg-gray-100 hover:bg-gray-200 transition p-3 rounded-md shadow-sm">
                                    <a href="{{route('blogs.post.show', [$blog, $recentPost])}}">
                                        {{ $recentPost->title }}
                                    </a>
                                </div>
                            @empty
                                <div>No posts yet.</div>
                            @endforelse
                        </div>
                    </div>
                </flux:card>
            @endforeach
        </div>
    </div>
@endsection
