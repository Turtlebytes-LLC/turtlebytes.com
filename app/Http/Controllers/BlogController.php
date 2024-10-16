<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with(['posts' => fn ($query) => $query->limit(10), 'author'])->get();

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void {}

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blogs = Blog::with(['posts' => fn ($query) => $query->limit(10), 'author'])->get();

        return view('blogs.show', compact('blog', 'blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog): void {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog): void {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): void {}
}
