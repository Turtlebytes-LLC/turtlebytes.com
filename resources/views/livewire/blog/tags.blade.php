<?php

use function Livewire\Volt\{state};

// taks in tags as a param
state(['tags' => []])

?>

<div>
    <div class="flex items-center justify-center flex-wrap gap-3">
        @foreach($tags as $tag)
            <a href="{{route('posts.tag', $tag)}}" class="bg-green-600 text-white px-2 py-1 rounded-full text-sm">{{ $tag }}</a>
        @endforeach
    </div>
</div>
