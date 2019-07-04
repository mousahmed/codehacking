@extends('layouts.admin')
@section('header')
    Create Category
@endsection
@section('content')

    {!! Form::open(['method'=>'Post', 'action'=>'AdminCategoriesController@store','class'=>'form-horizontal']) !!}
    {{ csrf_field() }}
    <div class="form-group">
        {!! Form::label('name', 'Category name:', ['class' =>'control-label']) !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Create ',['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}

    @include('errors.formErrors')

@endsection
