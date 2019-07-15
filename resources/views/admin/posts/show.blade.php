@extends('layouts.admin')

@section('header')
    {{$record->title}}
@endsection

@section('content')
    <h4>{{$record->content}}</h4>
    <br>
    <br>
    <h2>Comments</h2>
    <hr>
    @foreach($record->comments as $comment)
        <h4>From: {{$comment->author}} </h4>
        <h4> {{$comment->content}} </h4>
        <h4> {{$comment->created_at->diffForHumans()}}</h4>
        <hr>
    @endforeach
@endsection