@extends('layouts.admin')

@section('header')
    Upload Photos
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endsection

@section('content')
{!! Form::open(['method'=>'Post', 'action'=>'AdminPhotosController@store','class'=>'dropzone','files'=>'true']) !!}
    {{ csrf_field() }}
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@endsection