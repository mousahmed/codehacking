@extends('layouts.admin')
@section('header')
    Create Post
@endsection
@section('content')

    {!! Form::open(['method'=>'Post', 'action'=>'AdminPostsController@store','class'=>'form-horizontal','files'=>'true']) !!}
    {{ csrf_field() }}
    <div class="form-group">
        {!! Form::label('title', 'Title:', ['class' =>'control-label']) !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('content', 'Content:' , ['class' =>'control-label']) !!}
        {!! Form::textarea('content',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Category:', ['class' =>'control-label']) !!}
        {!! Form::select('category_id',[''=>'Choose Category'] + $records,null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('photo_id', 'Upload Photo:', ['class' =>'control-label']) !!}
        {!! Form::file('photo_id') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Create ',['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}

    @include('errors.formErrors')

@endsection
