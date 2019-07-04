@extends('layouts.admin')
@section('header')
    All Categories
@endsection
@section('content')

    @if(Session::has('deleted_category'))
        <p class="alert alert-danger">{{session('deleted_category')}}</p>
    @endif

    @if(Session::has('created_category'))
        <p class="alert alert-success">{{session('created_category')}}</p>
    @endif

    @if(Session::has('updated_category'))
        <p class="alert alert-success">{{session('updated_category')}}</p>
    @endif
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
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
                    <td><a href="{{route('admin.categories.show',$record->id)}}">{{$record->name}}</a></td>
                    <td>{{$record->created_at->diffForHumans()}}</td>
                    <td>{{$record->updated_at->diffForHumans()}}</td>
                    <td><a href="{{route('admin.categories.edit',$record->id)}}" class="btn btn-primary">Edit</a></td>
                    <td><a href="/admin/categories/delete/confirm/{{$record->id}}" class="btn btn-danger">Delete</a></td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
    <a href="{{asset(route('admin.categories.create'))}}" class="btn btn-success">Create Categories</a>


@endsection
