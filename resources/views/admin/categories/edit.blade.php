@extends('layouts.admin')

@section('header')
    Edit Category
@endsection

@section('content')


        {!! Form::model($record ,['method'=>'PATCH', 'action'=>['AdminCategoriesController@update',$record->id],'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}
        <div class="form-group">
            {!! Form::label('name', 'Category name:', ['class' =>'control-label']) !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>


        <div class="form-group ">
            {!! Form::submit('Update',['class'=>'btn btn-primary pull-left']) !!}


            {!! Form::close() !!}


            <a href="/admin/categories/delete/confirm/{{$record->id}}" class="btn btn-danger pull-right">Delete</a>
        </div>


        @include('errors.formErrors')

@endsection