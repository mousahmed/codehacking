@extends('layouts.admin')

@section('header')
    All Comments
@endsection

@section('content')
    @if(Session::has('deleted_comment'))
        <p class="alert alert-danger">{{session('deleted_comment')}}</p>
    @endif
    @if(count($records)> 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Photo</th>
                <th scope="col">Author</th>
                <th scope="col">Email</th>
                <th scope="col">Post</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Status</th>
                <th scope="col">Show</th>
                <th scope="col">Delete</th>

            </tr>
            </thead>
            <tbody>
            @if($records)
                @foreach($records as $record)
                    <tr>
                        <th scope="row">{{$record->id}}</th>
                        <td><img height="60px" width="40px"
                                 src="{{$record->photo ? $record->photo : "http://placehold.it/50x50"}}" alt=""></td>
                        <td>{{$record->author}}</td>
                        <td>{{$record->email}}</td>
                        <td><a href="{{route('admin.posts.show',$record->post->id)}}">{{$record->post->title}}</a></td>
                        <td>{{$record->created_at->diffForHumans()}}</td>
                        <td>{{$record->updated_at->diffForHumans()}}</td>
                        <td>
                            @if($record->is_active == 0)
                                {!! Form::model($record ,['method'=>'PATCH', 'action'=>['PostCommentsController@update',$record->id]]) !!}
                                {{ csrf_field() }}
                                <input type="hidden" name="is_active" value="1">
                                {!! Form::submit('Approve',['class'=>'btn btn-primary']) !!}


                                {!! Form::close() !!}

                            @else
                                {!! Form::model($record ,['method'=>'PATCH', 'action'=>['PostCommentsController@update',$record->id]]) !!}
                                {{ csrf_field() }}
                                <input type="hidden" name="is_active" value="0">
                                {!! Form::submit('Unapprove',['class'=>'btn btn-danger']) !!}


                                {!! Form::close() !!}
                            @endif

                        </td>
                        <td><a href="{{route('admin.comments.show',$record->id)}}" class="btn btn-success">Show</a></td>
                        <td><a href="/admin/comments/delete/confirm/{{$record->id}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach

            @endif
            @else
                <h2>No Comments</h2>
            @endif
            </tbody>
        </table>
@endsection