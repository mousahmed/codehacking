<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $records = Post::paginate(10);
        return view('admin.posts.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $records = Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('records'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $user = Auth::user();
        $input = $request->all();
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['path'=>$name]);
            $input['photo_id'] = $photo->id;

        }
        $user->posts()->create($input);
        Session::flash('created_post','The post has been created');
        return redirect(route('admin.posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $record = Post::findOrFail($id);
        return view('admin.posts.show',compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $record = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit',compact('record','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();
        $record = Post::findOrFail($id);
        if($file = $request->file('photo_id')){
            unlink(public_path().$record->photo->path);
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['path'=>$name]);
            $input['photo_id'] = $photo->id;

        }
        $record->update($input);
        Session::flash('updated_post','The post has been updated');
        return redirect(route("admin.posts.index"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete($id){

        $record = Post::findOrFail($id);
        return view('admin.posts.delete',compact('record'));
    }

    public function destroy($id)
    {
        //
        $record = Post::findOrFail($id);
        if($record->photo) {
            unlink(public_path().$record->photo->path);
            $record->photo()->delete();
        }
        $record->delete();
        Session::flash('deleted_post','The Post has been deleted');
        return redirect(route('admin.posts.index')) ;
    }

    public function post($slug){
        $record = Post::findBySlugOrFail($slug);
        $comments = $record->comments;
        $categories = Category::all();
        return view('post',compact('record','comments','categories'));
    }
}
