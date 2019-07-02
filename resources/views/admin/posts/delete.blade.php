@extends('layouts.admin')

@section('header')
    Delete Post
@endsection

@section('content')

    <h2>Are you sure you want to delete [{{$record->title}}] post?</h2>
    <div class="col-lg-2">
        <a href="{{route('admin.posts.index')}}" class="btn btn-lg btn-primary pull-right">NO</a>
        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy',$record->id],'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

        <div class="form-group">
            {!! Form::submit('Yes',['class'=>'btn btn-lg btn-danger pull-left']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection
