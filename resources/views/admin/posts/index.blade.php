@extends('layouts.admin')
@section('header')
    All Posts
@endsection
@section('content')

    @if(Session::has('deleted_post'))
        <p class="alert alert-danger">{{session('deleted_post')}}</p>
    @endif

    @if(Session::has('created_post'))
        <p class="alert alert-success">{{session('created_post')}}</p>
    @endif

    @if(Session::has('updated_post'))
        <p class="alert alert-success">{{session('updated_post')}}</p>
    @endif
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Publisher</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">View</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>

        </tr>
        </thead>
        <tbody>
        @if($records)
            @foreach($records as $record)
                <tr>
                    <th scope="row">{{$record->id}}</th>
                    <td><img height="60px" width="40px" src="{{$record->photo ? $record->photo->path : "http://placehold.it/50x50"}}" alt=""></td>
                    <td><a href="{{route('admin.posts.show',$record->id)}}">{{$record->title}}</a></td>
                    <td>{{$record->category->name}}</td>
                    <td>{{$record->user->name}}</td>
                    <td>{{$record->created_at->diffForHumans()}}</td>
                    <td>{{$record->updated_at->diffForHumans()}}</td>
                    <td><a href="{{route('home.post',$record->slug)}}" class="btn btn-primary">View Post</a></td>
                    <td><a href="{{route('admin.posts.edit',$record->id)}}" class="btn btn-primary">Edit</a></td>
                    <td><a href="/admin/posts/delete/confirm/{{$record->id}}" class="btn btn-danger">Delete</a></td>
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
