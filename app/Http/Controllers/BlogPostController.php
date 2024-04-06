<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogPosts = BlogPost::latest()->get();
        return view('blog-posts.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog-posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $blogPost = BlogPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('blog-posts.index')->with('success', 'Blog post created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $blogPost = BlogPost::findOrFail($id);
        return view('blog-posts.show', compact('blogPost'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $blogPost = BlogPost::findOrFail($id);
        
        
        return view('blog-posts.edit', compact('blogPost'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        
    
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
    
        // Check if the authenticated user is the creator of the blog post
        if ($request->user()->id !== $blogPost->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action. You are not authorize to perform this action');

        }
        $blogPost->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $blogPost = BlogPost::findOrFail($id);
        if (auth()->id() !== $blogPost->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action. You are not authorize to perform this action');

        }
        $blogPost->delete();

        return redirect()->route('blog-posts.index')->with('success', 'Blog post deleted successfully.');
   
    }
    
}
