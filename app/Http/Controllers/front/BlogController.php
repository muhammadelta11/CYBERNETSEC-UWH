<?php

namespace App\Http\Controllers\front;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with('category');

        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->where('blog_category_id', $request->category);
        }

        $data = [
            'blogs' => $query->paginate(9),
            'selectedCategory' => $request->category,
        ];

        return view('front.blog.index', $data);
    }

    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $blog = Blog::with('category')->find($dec_id);

        if (!$blog) {
            abort(404);
        }

        $data = [
            'blog' => $blog,
            'recentBlogs' => Blog::latest()->take(5)->get(),
            'categories' => \App\BlogCategory::withCount('blogs')->get(),
            'relatedBlogs' => Blog::where('blog_category_id', $blog->blog_category_id)
                ->where('id', '!=', $blog->id)
                ->inRandomOrder()
                ->take(3)
                ->get(),
        ];

        return view('front.blog.detail', $data);
    }
}
