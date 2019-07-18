<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $categories = Category::all();
        return view('layouts.blog-home', compact('categories'));
    }

    public function index()
    {
        $categories = Category::all();
        $records = Post::paginate(5);
        return view('home', compact('records', 'categories'));
    }

    public function categoryPosts($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        return view('category-posts', compact('category', 'categories'));
    }


}
