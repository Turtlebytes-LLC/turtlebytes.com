@php use Illuminate\Mail\Markdown; @endphp
@extends('layouts.app')

@section('content')
    <div class="rounded shadow bg-green-50 space-y-6 p-6">
        <flux:heading size="xl" class="text-center">{{ $post->title }}</flux:heading>

        @if ($post->excerpt)
            <flux:subheading class="text-center">
                {{ $post->excerpt }}
            </flux:subheading>
        @endif

        <flux:subheading class="text-center">
            <div class="text-gray-600 mb-4">{{ $post->created_at->format('F j, Y') }}</div>
        </flux:subheading>

        @livewire('blog.tags', ['tags' => $post->tags])

        <article class="p-6 shadow-md rounded-md">
            <div class="prose">
                {!! Markdown::parse($post->body) !!}
            </div>
        </article>

        <livewire:comments :post="$post"/>
    </div>

@endsection
