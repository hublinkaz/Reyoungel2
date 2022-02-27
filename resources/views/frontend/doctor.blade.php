@extends('frontend.layout')

@section('content')

<br>
<br>
<br>
<br>
<br>
<br>
    <div class="container container-content">
        <div class="single-product-detail">

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="flex product-img-slide">
                        <div class="product-images">
                            <div class="main-img js-product-slider">
                                @foreach(json_decode($doctor->images) as $image)
                                <a href="#" class="hover-images effect"><img src="/public/assets/images/doctors/{{$image}}" alt="photo" class="img-responsive"></a>
                                @endforeach
                                @php
                                $link='https://www.youtube.com/embed/'.$doctor->video_url;


                                 @endphp

                            </div>
                        </div>
                        <div class="multiple-img-list-ver2 js-click-product">

                            @foreach(json_decode($doctor->images) as $image)
                                <div class="product-col">
                                    <div class="img">
                                        <img src="/public/assets/images/doctors/{{$image}}" alt="images" class="img-responsive">
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="single-product-info product-info product-grid-v2">
                        <h3 class="product-title"><a href="#">{{$doctor->name}}</a></h3>
                        <div class="product-price">
                            <span>{{ trans('lang.doctor_') }}</span>
                            <span>{{$doctor->workplace}}</span>
                        </div>
                        <p class="product-desc">{{$doctor->phone}}</p>
                        <p class="product-desc">{{$doctor->location}}</p>

                        <div class="short-desc">
                            {!! $doctor->text !!}

                        </div>
                        @if(!empty($link))
                            <a href="#" class="hover-images effect">  <iframe width="100%" height="100%" src="{{$link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- EndContent -->
    </div>



@endsection
