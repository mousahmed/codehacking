@extends('layouts.admin')

@section('header')
    {{$record->title}}
@endsection

@section('content')
    {{$record->content}}
@endsection