@extends('layouts.admin')

@section('header')
    Edit Post
@endsection

@section('content')

        {!! Form::model($record ,['method'=>'PATCH', 'action'=>['AdminPostsController@update',$record->id],'class'=>'form-horizontal','files'=>'true']) !!}
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
            {!! Form::select('category_id',$categories ,null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Upload Photo:', ['class' =>'control-label']) !!}
            {!! Form::file('photo_id') !!}
        </div>


        <div class="form-group pull-left">
            {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}


        <div class="form-group pull-right ">
            <a href="/admin/posts/delete/confirm/{{$record->id}}" class="btn btn-danger">Delete</a>
        </div>


        @include('errors.formErrors')

@endsection