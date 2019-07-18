@extends('layouts.admin')

@section('header')
    Category {{$record->name}} Posts
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">Title</th>
            <th scope="col">Publisher</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>

        </tr>
        </thead>
        <tbody>
        @if($record)
            @foreach($record->posts as $post)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><img height="60px" width="40px"
                             src="{{$post->photo ? $post->photo->path : "http://placehold.it/50x50"}}" alt=""></td>
                    <td><a href="{{route('admin.posts.show',$post->id)}}">{{$post->title}}</a></td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td><a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-primary">Edit</a></td>
                    <td><a href="/admin/posts/delete/confirm/{{$post->id}}" class="btn btn-danger">Delete</a></td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
@endsection