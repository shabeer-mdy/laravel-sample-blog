<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Session;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blogs = Blog::belongsToMe()->get();
        return view('blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);

        $blog = new Blog();
        $slug = $blog->generateSlug($request->title);
        $validated_data['slug'] = $slug;
        $validated_data['user_id'] = auth()->id();

        Blog::create($validated_data);
        Session::flash('message', 'Blog data created successfully');
        return redirect()->route('blogs');
    }

    public function edit(Blog $blog)
    {
        if($blog->user_id !== auth()->id())
        {
            abort(401);
        }
        return view('blog.create', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        if($blog->user_id !== auth()->id())
        {
            abort(401);
        }
        $validated_data = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);

        $blog->title = $request->title;
        $blog->slug = $blog->generateSlug($request->title);
        $blog->description = $request->description;
        $blog->save();
        Session::flash('message', 'Blog data updated successfully');
        return redirect()->route('blogs');
    }

    public function delete(Blog $blog)
    {
        if($blog->user_id !== auth()->id())
        {
            abort(401);
        }
        $blog->delete();
        return redirect()->route('blogs');
    }
}
