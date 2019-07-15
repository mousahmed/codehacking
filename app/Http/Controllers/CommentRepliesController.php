<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $records = CommentReply::all();
        return view('admin.comments.replies.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();

        $data = array(
            'comment_id' => $request->comment_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo->path,
            'content' => $request->content
        );
        CommentReply::create($data);
        $request->session()->flash('reply_message', "Your Reply has been submitted and is waiting for approval");
        return redirect()->back();
    }
    public function createReply(Request $request)
    {
        //
        $user = Auth::user();

        $data = array(
            'comment_id' => $request->comment_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo->path,
            'content' => $request->content
        );
        CommentReply::create($data);
        $request->session()->flash('reply_message', "Your Reply has been submitted and is waiting for approval");
        return redirect()->back();
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
        $record = CommentReply::findOrFail($id);
        return view('admin.comments.replies.show',compact('record'));
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
        CommentReply::findOrFail($id)->update($request->all());
        return redirect()->back();
    }
    public function confirmDelete($id)
    {

        $record = CommentReply::findOrFail($id);
        return view('admin.comments.replies.delete', compact('record'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $record = CommentReply::findOrFail($id);
        $record->delete();
        Session::flash('deleted_reply', 'The Reply has been deleted');
        return redirect(route('admin.comment.replies.index'));
    }
}
