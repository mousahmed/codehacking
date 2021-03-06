@extends('layouts.admin')

@section('header')
    Delete Category
@endsection

@section('content')

    <h2>Are you sure you want to delete <span class="alert alert-danger">{{$record->name}}</span> category?</h2>
    <div class="col-lg-2">
        <a href="{{route('admin.categories.index')}}" class="btn btn-lg btn-primary pull-right">NO</a>
        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy',$record->id],'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

        <div class="form-group">
            {!! Form::submit('Yes',['class'=>'btn btn-lg btn-danger pull-left']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection
