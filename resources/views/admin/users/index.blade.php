@extends('layouts.admin')
@section('header')
    All Users
@endsection
@section('content')

    @if(Session::has('deleted_user'))
        <p class="alert alert-danger">{{session('deleted_user')}}</p>
    @endif

    @if(Session::has('created_user'))
        <p class="alert alert-success">{{session('created_user')}}</p>
    @endif

    @if(Session::has('updated_user'))
        <p class="alert alert-success">{{session('updated_user')}}</p>
    @endif
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>

        </tr>
        </thead>
        <tbody>
        @if($records)
            @foreach($records as $record)
                <tr>
                    <th scope="row">{{$record->id}}</th>
                    <td><img  src="{{$record->gravatar ? $record->gravatar : "http://placehold.it/50x50"}}" alt=""></td>
                    <td><a href="{{route('admin.users.show',$record->id)}}">{{$record->name}}</a></td>
                    <td>{{$record->email}}</td>
                    <td>{{$record->role->name}}</td>
                    <td>{{($record->is_active === 1 ? 'Active':'Not Active')}}</td>
                    <td>{{$record->created_at->diffForHumans()}}</td>
                    <td>{{$record->updated_at->diffForHumans()}}</td>
                    <td><a href="{{route('admin.users.edit',$record->id)}}" class="btn btn-primary">Edit</a></td>
                    <td><a href="/admin/users/delete/confirm/{{$record->id}}" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <a href="{{asset(route('admin.users.create'))}}" class="btn btn-success">Create Users</a>

    <a href="{{asset(route('admin.posts.create'))}}" class="btn btn-success">Create Posts</a>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$records->render()}}
        </div>
    </div>
@endsection
