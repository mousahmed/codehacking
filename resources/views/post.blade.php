@extends('layouts.blog-post')

@section('content')
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$record->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$record->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$record->created_at->format('j F Y')}}
        at {{$record->created_at->format('h:i A')}}</p>

    <hr>

    <!-- Preview Image -->
    <img height="400px" width="600px" class="img-responsive" src="{{$record->photo ? $record->photo->path :  $record->photoPlaceHolder()}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{!! $record->content !!}</p>

    <hr>
    @if(Auth::check())
        @if(Session::has('comment_message'))
            <div class="alert alert-success"> {{session('comment_message')}}</div>
        @endif
        @if(Session::has('reply_message'))
            <div class="alert alert-success"> {{session('reply_message')}}</div>
        @endif
        <div class="well">
            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store',]) !!}
            {{ csrf_field() }}
            <input type="hidden" name="post_id" value={{$record->id}}>
            <div class="form-group">
                <h4>
                    {!! Form::label('content','Leave a Comment:', ['class' =>'control-label']) !!}
                </h4>
                {!! Form::textarea('content',null,['class'=>'form-control','rows'=>4]) !!}

            </div>
            <div class="form-group">
                {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>

        <hr>
    @endif
    <!-- Posted Comments -->


    <!-- Comment -->
    @if($comments)

        @foreach($comments as $comment)
            @if($comment->is_active == 1)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{Auth::user()->gravatar}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author}}
                            <small>{{$comment->created_at->format('j F Y h:i A')}}</small>
                        </h4>
                    {{$comment->content}}
                    <!-- Nested Comment -->

                        @if(count($comment->replies) > 0 )
                            @foreach($comment->replies as $reply)
                                <div class="nested-comment media" style="margin-top: 40px;">
                                    @if($reply->is_active == 1)

                                        <a class="pull-left" href="#">
                                            <img class="media-object"
                                                 src="{{Auth::user()->gravatar}}" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{$reply->author}}
                                                <small>{{$reply->created_at->format('j F Y h:i A')}}</small>
                                            </h4>
                                            {{$reply->content}}
                                        </div>

                                    @endif
                                </div>
                            @endforeach
                        @endif

                        <div class="comment-reply-container" style="margin-top: 20px">
                            <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                            @if(Auth::check())
                                <div class="comment-reply col-sm-10 " style="margin-top: 20px">
                                    <div class="well">
                                        {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply',]) !!}
                                        {{ csrf_field() }}
                                        <input type="hidden" name="comment_id" value={{$comment->id}}>
                                        <div class="form-group">
                                            <h4>
                                                {!! Form::label('content','Leave a Reply:', ['class' =>'control-label']) !!}
                                            </h4>
                                            {!! Form::textarea('content',null,['class'=>'form-control','rows'=>2]) !!}

                                        </div>
                                        <div class="form-group">
                                            {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                                        </div>

                                        {!! Form::close() !!}

                                    </div>
                                </div>
                        @endif


                        <!-- End Nested Comment -->
                        </div>

                    </div>
                </div>
            @endif
            <hr>
        @endforeach
    @endif

@endsection

@section('scripts')
    <script>

        $('.comment-reply-container .toggle-reply').click(function () {
            $(this).next().slideToggle();
        });

    </script>
@endsection