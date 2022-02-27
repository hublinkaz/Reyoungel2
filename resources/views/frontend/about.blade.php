@extends('frontend.layout')

@section('content')

<br>
<br>
<br>
<br>
<br>
    <div class="container container-content">

    </div>
    <div class="container container-content">
        <div class="zoa-about text-center">
            <h3>{{ trans('lang.About') }}</h3>
            <div class="about-banner">
                @if (!empty($slides[0]->image))

                    <div class="hover-images"><img src="public/assets/images/slider/{{$slides[0]->image}}" class="img-responsive" alt=""></div>
                @endif
                <div class="zoa-info">
                    <div class="container p-0">
                        <div class="zoa-inside flex align-items-center justify-center">
                            <p style="color:white; font-size:16px;">{{ trans('lang.Address Office') }} </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="about-content bd-bottom">
            <div class="row">
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <!--<div class="about-sm">-->
                    <!--    <div class="hover-images">-->
                    <!--        <img src="/public/frontend/img/about/small_img.jpg" class="img-responsive" alt="">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="about-info">

                        <h2 style="text-align: center">
                            <b style="color:#0a6aa1">
                                {{$pages->{'title_'.app()->getLocale()} }}
                            </b>
                        </h2>
                        <div class="about-desc">
{{--                            <p>Housing an international selection of upcoming to established designers for over fifteen years. </p>--}}
                            <p> {!! $pages->{'body_'.app()->getLocale()} !!}</p>
                        </div>
{{--                        <div class="sign">--}}
{{--                            <img src="/public/frontend/img/about/signature.jpg" class="img-responsive" alt="">--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="about-img">
                        <div class="hover-images"><img src="/public/frontend/img/about/about-2.jpg" class="img-responsive" alt=""></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- shipping-container Start -->
        <div class="shipping-container">
            <div class="container">
                <div class="col-md-4">
                    <div class="shipping-item">
{{--                        <p class="images"></p>--}}
                        <div class="text">
                            <h3>{{ trans('lang.Fast') }}</h3>
                            <p>{{ trans('lang.Fast_details') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="shipping-item">
{{--                        <p class="images"></p>--}}
                        <div class="text">
                            <h3>{{ trans('lang.Quality') }}</h3>
                            <p>{{ trans('lang.Quality_details') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="shipping-item">
                        {{--                        <p class="images"></p>--}}
                        <div class="text">
                            <h3>{{ trans('lang.Servicedesc') }}</h3>
                            <p>{{ trans('lang.Servicedesc_details') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Shipping-Container -->
        <style>
            .shipping-container {
                margin: 110px 0px;
                display: inline-block;
                width: 100%;
            }

            .shipping-container .col-md-4 {
                padding: 0px 15px;
            }

            .shipping-container .col-md-4 .shipping-item {
                border: 1px dashed #cdcdcd;
                padding: 20px;
                height: 250px;
                border-radius: 10px;
                text-align: center;
                position: relative;
            }

            .shipping-container .col-md-4 .shipping-item:hover {
                border: 1px dashed #96b76c;
                cursor: pointer;
            }

            .shipping-container .col-md-4 .shipping-item:hover .images {
                /*background-image: url(../images/Futurelife-icon-shipping-hover.png);*/
            }

            .shipping-container .col-md-4 .shipping-item:hover .text h3 {
                color: #96b76c;
            }

            .shipping-container .col-md-4 .shipping-item:hover .text p {
                color: #96b76c;
            }

            .shipping-container .col-md-4 .shipping-item .images:after, .shipping-container .col-md-4 .shipping-item .images:before, .shipping-container .col-md-4 .shipping-item .text:after, .shipping-container .col-md-4 .shipping-item .text:before {
                position: absolute;
                content: "";
                width: 10px;
                height: 10px;
                z-index: 3;
                top: -2px;
                right: -3px;
                border-radius: 100%;
                box-shadow: inset 0 0 0 4px white, 0 0 0 3px white;
                border: solid transparent 3px;
            }

            .shipping-container .col-md-4 .shipping-item .images {
                display: inline-block;
                height: 50px;
                width: 100%;
                /*background: url(../images/Futurelife-icon-shipping.png) no-repeat scroll center top;*/
                margin: 15px 0px;
            }

            .shipping-container .col-md-4 .shipping-item .images:before {
                right: inherit;
                left: -3px;
            }

            .shipping-container .col-md-4 .shipping-item .text:after, .shipping-container .col-md-4 .shipping-item .text:before {
                top: inherit;
                bottom: -2px;
            }

            .shipping-container .col-md-4 .shipping-item .text:before {
                right: inherit;
                left: -3px;
            }

            .shipping-container .col-md-4 .shipping-item .text h3 {
                font-size: 16px;
                font-weight: 700;
                color: #666;
                line-height: 24px;
            }

            .shipping-container .col-md-4 .shipping-item .text p {
                font-family: "Lora" !important;
                font-style: italic;
                color: #aaa;
                line-height: 24px;
                margin-bottom: 20px;
            }

            .shipping-container .col-md-4:nth-child(2) .shipping-item .images {
                background-position: center top -124px;
            }

            .shipping-container .col-md-4:last-child .shipping-item .images {
                background-position: center top -246px;
            }

        </style>


{{--        <div class="about-bottom bd-bottom">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-3 col-sm-3 col-xs-12 about-element">--}}
{{--                    <h4>origin</h4>--}}
{{--                    <p>1. International standard hardware and facilities</p>--}}
{{--                </div>--}}
{{--                <div class="col-md-3 col-sm-3 col-xs-12 about-element">--}}
{{--                    <h4>team</h4>--}}
{{--                    <p>European CE & ISO </p>--}}
{{--                </div>--}}
{{--                <div class="col-md-3 col-sm-3 col-xs-12 about-element">--}}
{{--                    <h4>practicality</h4>--}}
{{--                    <p>High-quality products. </p>--}}
{{--                </div>--}}
{{--                <div class="col-md-3 col-sm-3 col-xs-12 about-element">--}}
{{--                    <h4>practicality</h4>--}}
{{--                    <p>Focus on the development of medical and beauty products, use continuous innovative technology to promote the healthy development of human society</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

@endsection
