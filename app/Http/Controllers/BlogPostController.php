<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Blog $blog)
    {
        $posts = Post::query()
                     ->when(request('tag'), fn($q) => $q->whereHasTags(request('tag')))
                     ->paginate();

        return view('blogs.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Blog $blog) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Blog $blog) {}

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog, Post $post)
    {
        return view('blogs.posts.show', compact('blog', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog, Post $post) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog, Post $post) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, Post $post) {}
}
