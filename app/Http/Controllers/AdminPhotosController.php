<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminPhotosController extends Controller
{
    //
    public function index()
    {

        $records = Photo::paginate(10);
        return view('admin.photos.index', compact('records'));
    }

    public function create()
    {
        return view('admin.photos.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        Photo::create(['path' => $name]);
    }

    public function confirmDelete($id)
    {

        $record = Photo::findOrFail($id);
        return view('admin.photos.delete', compact('record'));
    }

    public function destroy($id)
    {
        //
        $record = Photo::findOrFail($id);
        unlink(public_path() . $record->path);
        Session::flash('deleted_photo', 'The photo has been deleted');
        $record->delete();

        return redirect(route('admin.photos.index'));
    }
    public function deletePhotos(Request $request){
        if(is_numeric($request->checkBoxArray)) {
            $records = Photo::findORFail($request->checkBoxArray);
            foreach ($records as $record) {
                unlink(public_path() . $record->path);
                Session::flash('deleted_photo', 'The photo has been deleted');
                $record->delete();
            }
        }
        return redirect(route('admin.photos.index'));
    }
}
