<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        $users = User::count();
        $posts = Post::count();
        $categories = Category::count(); 
        $photos = Photo::count();
        return view('admin/index', compact('users','posts','categories','photos'));
    }
}
