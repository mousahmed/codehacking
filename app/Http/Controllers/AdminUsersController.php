<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $records = User::all();
        return view('admin.users.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $records = Role::lists('name', 'id')->all();
        return view('admin.users.create', compact('records'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['path' => $name]);
            $input['photo_id'] = $photo->id;

        }

        User::create($input);

        Session::flash('created_user', 'The user has been created');
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $record = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.edit', compact('record', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        //
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        $record = User::findOrFail($id);
        if ($file = $request->file('photo_id')) {
            unlink(public_path() . $record->photo->path);
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['path' => $name]);
            $input['photo_id'] = $photo->id;

        }
        $record->update($input);
        Session::flash('updated_user', 'The user has been updated');
        return redirect(route("admin.users.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete($id)
    {

        $record = User::findOrFail($id);
        return view('admin.users.delete', compact('record'));
    }

    public function destroy($id)
    {
        //
        $record = User::findOrFail($id);
        if ($record->photo) {
            unlink(public_path() . $record->photo->path);
            $record->photo()->delete();
        }
        if ($record->posts) {
            foreach ($record->posts->all()as $post) {
                if ($post->photo) {
                    unlink(public_path() . $post->photo->path);
                    $post->photo()->delete();
                }
            }
        }
        $record->delete();
        Session::flash('deleted_user', 'The user has been deleted');
        return redirect(route('admin.users.index'));
    }
}
