@extends('layouts.admin')

@section('header')
    Edit User
@endsection

@section('content')
    <div class="col-sm-3">
        <img src="{{$record->photo? $record->photo->path : "http://placehold.it/400x400"}}" alt=""
             class="img-responsive img-rounded">
    </div>

    <div class="col-sm-7">
        {!! Form::model($record ,['method'=>'PATCH', 'action'=>['AdminUsersController@update',$record->id],'class'=>'form-horizontal','files'=>'true']) !!}
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
            {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('is_active', 'Status:', ['class' =>'control-label']) !!}
            {!! Form::select('is_active',array(1=>'active', 0=>'not active'),null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Upload Photo:', ['class' =>'control-label']) !!}
            {!! Form::file('photo_id',['class'=>'']) !!}
        </div>


        <div class="form-group pull-left">
            {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}


        <div class="form-group pull-right ">
            <a href="/admin/users/delete/confirm/{{$record->id}}" class="btn btn-danger">Delete</a>
        </div>


        @include('errors.formErrors')
    </div>
@endsection