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


        <div class="form-group ">
            {!! Form::submit('Update',['class'=>'btn btn-primary pull-left']) !!}


        {!! Form::close() !!}


            <a href="/admin/posts/delete/confirm/{{$record->id}}" class="btn btn-danger pull-right">Delete</a>
        </div>


        @include('errors.formErrors')

@endsection