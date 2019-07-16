@extends('layouts.admin')
@section('header')
    All Media
@endsection
@section('content')

    @if(Session::has('deleted_photo'))
        <p class="alert alert-danger">{{session('deleted_photo')}}</p>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">Belongs To</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Delete</th>


        </tr>
        </thead>
        <tbody>
        @if($records)
            @foreach($records as $record)
                <tr>
                    <th scope="row">{{$record->id}}</th>
                    <td><img height="60px" width="40px" src="{{$record->path}}" alt=""></td>
                    <td>
                        @if($record->user) {{'User/ ' . $record->user->name }}
                        @elseif($record->post) {{'Post/ ' . $record->post->title }}
                        @else{{'none'}}
                        @endif

                    </td>
                    <td>{{$record->created_at->diffForHumans()}}</td>
                    <td>{{$record->updated_at->diffForHumans()}}</td>
                    <td><a href="/admin/photos/delete/confirm/{{$record->id}}" class="btn btn-danger">Delete</a></td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
    <a href="{{asset(route('admin.posts.create'))}}" class="btn btn-success">Create Posts</a>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$records->render()}}
        </div>
    </div>

@endsection
