@extends('layouts.admin')

@section('header')
    <h2>{{$record->author}}'s Comment</h2>
@endsection

@section('content')
    <h4>{{$record->content}}</h4>
    <a href="/admin/comments/delete/confirm/{{$record->id}}" class="btn btn-danger">Delete</a>
    <br>
    <br>
    <h3>Replies</h3>
    <hr>
    @foreach($record->replies as $reply)
        <div class="well">
            <p><i class="fa fa-user"> </i> From: {{$reply->author}} / {{$reply->email}} <i class="fa fa-clock-o"> Posted At: {{$reply->created_at->format('j F Y h:i A')}}</i> </p>

            <p> {{$reply->content}} </p>

            @if($reply->is_active == 0)
                {!! Form::model($reply ,['method'=>'PATCH', 'action'=>['CommentRepliesController@update',$reply->id]]) !!}
                {{ csrf_field() }}
                <input type="hidden" name="is_active" value="1">
                {!! Form::submit('Approve',['class'=>'btn btn-primary']) !!}
                <a href="/admin/comment/replies/delete/confirm/{{$reply->id}}" class="btn btn-danger ">Delete</a>
                {!! Form::close() !!}

            @else
                {!! Form::model($reply ,['method'=>'PATCH', 'action'=>['CommentRepliesController@update',$reply->id]]) !!}
                {{ csrf_field() }}
                <input type="hidden" name="is_active" value="0">
                {!! Form::submit('Unapprove',['class'=>'btn btn-danger']) !!}

                <a href="/admin/comment/replies/delete/confirm/{{$reply->id}}" class="btn btn-danger ">Delete</a>
                {!! Form::close() !!}
            @endif


        </div>
        <hr>

    @endforeach

@endsection