@extends('layouts.blog-home')

@section('content')
    <!-- Blog Post -->
    <div class="col-md-8">
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
        <img height="400px" width="600px" class="img-responsive"
             src="{{$record->photo ? $record->photo->path :  $record->photoPlaceHolder()}}" alt="">

        <hr>

        <!-- Post Content -->
        <p>{!! $record->content !!}</p>

        <hr>
        <div id="disqus_thread"></div>
        <script>

            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */
            (function () { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = 'https://codehacking-rvljm81qeh.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>


        <script id="dsq-count-scr" src="//codehacking-rvljm81qeh.disqus.com/count.js" async></script>
    </div>
@endsection

@section('scripts')
    <script>

        $('.comment-reply-container .toggle-reply').click(function () {
            $(this).next().slideToggle();
        });

    </script>
@endsection