@extends('frontend.layout')

@section('content')
<br>
<br>
<br>
    <div class="blog-list">
        <div class="container">
            <div class="row">
                @foreach($blogs as $blog)
                <div class="blog-list-item">
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="blog-list-info">
                            <div class="blog-tag">
                                <div class="blog-date text-uppercase">
                                    {{$blog->created_at }}
                                </div>
                            </div>
                            <h3 class="blog-title">
                                <a href="/blog/{{$blog->id}}">{{ $blog->{'name_'.app()->getLocale()}   }}</a>
                            </h3>
                            <p class="blog-desc"> {!! \Illuminate\Support\Str::limit($blog->{'desc_'.app()->getLocale()}  , 500, ' ...') !!} </p>
                            <a href="/blog/{{$blog->id}}" class="read-more">Ətraflı</a>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="blog-img">
                            <a href="/blog/{{$blog->id}}" class="effect-img3 plus-zoom">
                                <img style="width:100%" src="public/assets/images/blog/{{$blog->image }}" alt="" class="img-reponsive">

                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <ul class="pagination">
                @if ($blogs->links()->paginator->hasPages())

                    {{ $blogs->render() }}

                @endif
            </ul>
        </div>
    </div>
    </div>
@endsection
