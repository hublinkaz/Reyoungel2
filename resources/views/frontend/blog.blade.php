@extends('frontend.layout')

@section('content')

    <div class="single-blog">
        <div class="container">

            <div class="single-blog-post">
                <h3 class="title">
                    <a href="">{{$blog->name_az }}</a>
                </h3>
                <div class="blog-tag">
                    <div class="blog-date">
                        {{$blog->created_at }}
                    </div>

                </div>
                <div class="single-blog-desc">
                    <div class="blog-second-img text-center">
                        <a href="" class="effect-img3 plus-zoom"><img src="/public/assets/images/blog/{{$blog->image }}" alt="Blog" class="img-responsive"></a>
                    </div>
                    <p style="width:100%">
                    {!! $blog->desc_az !!}
                    </p>


                </div>
            </div>

        </div>
    </div>

@endsection
