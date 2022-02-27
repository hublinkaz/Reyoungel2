@extends('frontend.layout')

@section('content')


    <!-- start Home Slider -->

    <!-- content -->
    <div class="slide v2">
        <div class="js-slider-v3">
            @foreach($slides as $slide)
                <div class="slide-img">
                    <img src="public/assets/images/slider/{{$slide->image}}" alt="" class="img-responsive">
                    <div class="box-center content1">
{{--                        <h4 style="color: #FFFFFF">{{$slide->text}}</h4>--}}
                        <h1 >{{$slide->{'text_'.app()->getLocale()} }}</h1>
                        <a  style="color: #FFFFFF" href="{{$slide->button_link}}" class="slide-btn">{{$slide->{'button_text_'.app()->getLocale()} }}</a>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="custom">
            <div class="pagingInfo"></div>
        </div>
    </div>
    <!-- End content -->


    <div class="banner pad">
        <div class="container container-content">
            <div class="row">
                @foreach($banners as $banner)
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="banner-img">
                        <a href="" class="effect-img3">
                            <img class="img-responsive" src="/public/assets/images/banner/{{$banner->image}}" alt="">
                        </a>
                        <div class="box-center content">

                        </div>
                    </div>
                                                <h4> {{$banner->{'text_'.app()->getLocale()} }}</h4>
                            <a href="{{$banner->url}}">{{ trans('lang.Details') }}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="zoa-product pad" id="products">
        <h3 class="title home-title text-center">{{ trans('lang.Products') }}</h3>
        <div class="container container-content">
            <div class="row engoc-row-equal">
                @foreach($products as $product)

                    <div class="col-xs-6 col-sm-4 col-md-15 col-lg-15 product-item">
                        <div class="product-img">
                            <a href="/product/{{$product->id}}"><img src="public/assets/images/product/{{$product->image}}" alt="" class="img-responsive"></a>
    {{--                        <div class="ribbon zoa-hot"><span>Hot</span></div>--}}
                            <div class="product-button-group">

                                <a href="#" class="add-to-cart zoa-btn zoa-addcart" data-id="{{$product->id}}" data-price="{{$product->price}}" data-name_az="{{$product->name_az}}" data-name_en="{{$product->name_en}}" data-name_ru="{{$product->name_ru}}" data-name_tr="{{$product->name_tr}}" data-image="{{$product->image}}" >
                                    <span class="zoa-icon-cart"></span>
                                </a>
                            </div>
                        </div>
                        <div class="product-info text-center">
                            <h3 class="product-title">
                                <a href="/product/{{$product->id}}">{{$product->{'name_'.app()->getLocale()} }}</a>
                            </h3>
                            @if(!\Illuminate\Support\Facades\Auth::guest())
                                <div class="product-price">
                                    <span>{{$product->price}} ₼</span>
                                </div>
                            @endif
                        </div>
                    </div>

                @endforeach

            </div>

        </div>
    </div>

{{--    <div class="newsletter">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-5 col-sm-6 col-xs-12">--}}
{{--                    <div class="newsletter-heading">--}}
{{--                        <h3>get in touch</h3>--}}
{{--                        <p>Subscribe for latest stories and promotions (35% sale)</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-7 col-sm-6 col-xs-12 flex-end">--}}
{{--                    <form class="form_newsletter" action="#" method="post">--}}
{{--                        <input type="email" value="" placeholder="Enter your emaill" name="EMAIL" id="mail" class="newsletter-input form-control">--}}
{{--                        <button id="subscribe" class="button_mini zoa-btn" type="submit">--}}
{{--                            Subscribe--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
