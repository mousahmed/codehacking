@extends('layouts.admin')
@section('header')
    Create Users
@endsection
@section('content')

    {!! Form::open(['method'=>'Post', 'action'=>'AdminUsersController@store','class'=>'form-horizontal','files'=>'true']) !!}
    {{ csrf_field() }}
    <div class="form-group">
        {!! Form::label('name', 'Name:', ['class' =>'control-label']) !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email:' , ['class' =>'control-label']) !!}
        {!! Form::email('email',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password:', ['class' =>'control-label']) !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm Password:', ['class' =>'control-label']) !!}
        {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('role_id', 'Role:', ['class' =>'control-label']) !!}
        {!! Form::select('role_id',[''=>'Choose Role'] + $records,null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('is_active', 'Status:', ['class' =>'control-label']) !!}
        {!! Form::select('is_active',array(1=>'active', 0=>'not active'),null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('photo_id', 'Upload Photo:', ['class' =>'control-label']) !!}
        {!! Form::file('photo_id',['class'=>'']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Create User',['class'=>'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}

    @include('errors.formErrors')

@endsection
