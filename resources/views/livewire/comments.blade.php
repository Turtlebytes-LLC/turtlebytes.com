<?php

use App\Models\Post;
use function Livewire\Volt\{state, action};
use App\Models\Comment;

state(['post', 'newComments']);

// Register the action
$saveComment = action(function () {
    $post = $this->post;
    $comment = $this->newComments;

    if (!empty(trim($comment))) {
        // Create a new comment for the post
        $post->comments()->create([
            'text' => $comment,
        ]);

        // Clear the comment input
        $this->newComments = '';

        // Refresh the post's comments
        $post->load('comments');
    }
});

$deleteComment = action(function (int $commentId) {
    // Find the comment
    $comment = Comment::find($commentId);

    // Delete the comment
    $comment->delete();

    // Refresh the post's comments
    $this->post->load('comments');
});

?>

<div class="mt-8 container-fluid mx-auto">
    <h2 class="text-2xl font-semibold mb-4">
        Comments
        @if($post->comments->count())
            <flux:badge variant="solid" color="sky" size="sm">{{ $post->comments->count() }}</flux:badge>
        @endif
    </h2>
    <div class="space-y-4">
        <!-- Tailwind textarea -->
        <div class="mt-4">
            <flux:textarea
                wire:model.live="newComments"
                placeholder="Add a comment..."
                wire:keydown.ctrl.enter="saveComment"
                max="100"
            />
        </div>

        <!-- Submit button -->
        <div class="mt-4">
            <flux:button wire:click="saveComment" variant="primary">
                Submit Comment
            </flux:button>
        </div>

        <flux:separator/>

        <!-- Loop through comments -->
        @forelse($post->some_comments as $comment)
            <div class="mx-6 bg-gray-100 p-4 shadow-md rounded-md lg:flex justify-between align-content-start">
                <p class="text-gray-600">{!! nl2br($comment->text) !!}</p>
                <div class="mt-2 text-sm text-gray-500">
                    {{ $comment->created_at->diffForHumans() }}
                    <flux:button size="sm" wire:click="deleteComment({{ $comment->id }})" wire:key="comment-delete-{{ $comment->id }}">
                        Delete
                    </flux:button>
                </div>
            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse
    </div>
</div>
