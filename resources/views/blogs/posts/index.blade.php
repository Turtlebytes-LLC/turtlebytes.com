@extends('layouts.app')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 space-x-4 space-y-6">
            @foreach ($posts as $post)
                <flux:card class="bg-green-100 pop-card">
                    <a href="{{route('blogs.post.show', [$post->blog, $post])}}" class="block decoration-0">
                        <flux:heading level="3" class="text-xl font-bold text-gray-800 mb-2">{{ $post->title }}</flux:heading>
                        <flux:text class="text-gray-700 mb-4">{{ \Illuminate\Support\Str::limit($post->description) }}</flux:text>
                        <div class="items-center mb-4 space-x-3">
                        </div>
                    </a>
                </flux:card>
            @endforeach

        </div>
        {!! $posts->links() !!}
    </div>
@endsection
