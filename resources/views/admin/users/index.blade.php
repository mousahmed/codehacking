@extends('layouts.admin')
@section('content')
    <h1>All Users</h1>
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
                    <td><img height="60px" width="40px" src="{{$record->photo ? $record->photo->path : "http://placehold.it/50x50"}}" alt=""></td>
                    <td>{{$record->name}}</td>
                    <td>{{$record->email}}</td>
                    <td>{{$record->role->name}}</td>
                    <td>{{($record->is_active === 1 ? 'Active':'Not Active')}}</td>
                    <td>{{$record->created_at->diffForHumans()}}</td>
                    <td>{{$record->updated_at->diffForHumans()}}</td>
                    <td><a href="{{route('admin.users.edit',$record->id)}}" class="btn btn-primary">Edit</a></td>
                    <td><a href="{{route('admin.users.destroy',$record->id)}}" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <a href="{{asset(route('admin.users.create'))}}" class="btn btn-success">Create Users</a>


@endsection
