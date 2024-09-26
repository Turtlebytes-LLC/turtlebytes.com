<?php

use function Livewire\Volt\{state};

// taks in tags as a param
state(['tags' => []])

?>

<div>
    <div class="flex items-center justify-center">
        @foreach($tags as $tag)
            <span class="bg-green-600 text-white px-2 py-1 rounded-full text-sm mr-2">{{ $tag }}</span>
        @endforeach
    </div>
</div>
