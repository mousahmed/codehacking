@extends('layouts.blog-home')



@section('content')

    <div class="col-md-8">
        <h2 class="page-header">
            {{$category->name}} Posts

        </h2>
    @if(count($category->posts) > 0)
        @foreach($category->posts as $record)

            <!-- First Blog Post -->
                <h2>
                    <a href="/post/{{$record->slug}}">{{$record->title}}</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">{{$record->user->name}}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted
                    on {{$record->created_at->format('j F Y' )}} at {{$record->created_at->format(' h:i A')}}
                </p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                {!! str_limit($record->content,100)!!}
                <a class="btn btn-primary" href="/post/{{$record->slug}}">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


            @endforeach
        <!-- Pager -->

        @else
            <h2>No posts for {{$category->name}} category yet </h2>
        @endif


    </div>

@endsection