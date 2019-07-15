@extends('layouts.admin')

@section('header')
    <h2>{{$record->author}}'s Reply</h2>
@endsection

@section('content')
    <h4>{{$record->content}}</h4>
    <a href="/admin/comment/replies/delete/confirm/{{$record->id}}" class="btn btn-danger">Delete</a>
@endsection