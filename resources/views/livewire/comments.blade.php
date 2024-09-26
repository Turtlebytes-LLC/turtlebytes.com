<?php

use function Livewire\Volt\{state, action};
use App\Models\Comment;

state(['post', 'comment']);

// Register the action
$saveComment = action(function () {
    $post = $this->post;
    $comment = $this->comment;

    if (!empty(trim($comment))) {
        // Create a new comment for the post
        $post->comments()->create([
            'text' => $comment,
        ]);

        // Clear the comment input
        state(['comment' => '']);

        // Refresh the post's comments
        $post->load('comments');
    }
});
?>

<div class="mt-8 container-fluid mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Comments</h2>
    <div class="space-y-4">
        <!-- Loop through comments -->
        @forelse($post->comments as $comment)
            <div class="bg-gray-100 p-4 shadow-md rounded-md">
                <p class="text-gray-600">{{ $comment->text }}</p>
                <div class="mt-2 text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse

        <!-- Tailwind textarea -->
        <div class="mt-4">
            <flux:textarea
                wire:model="comment"
                placeholder="Add a comment..."
            />
        </div>

        <!-- Submit button -->
        <div class="mt-4">
            <flux:button wire:click="saveComment" variant="primary">
                Submit Comment
            </flux:button>
        </div>
    </div>
</div>
