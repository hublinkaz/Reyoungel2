@extends('frontend.layout')

@section('content')
<br>
<br>

<br>

    <div class="container container-content">
        <ul class="breadcrumb v2">
        </ul>
    </div>
    <div class="container container-content">
        <div class="single-product-detail">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="flex product-img-slide">
                        <div class="product-images">
                            <div class="ribbon zoa-sale"><span></span></div>
                            <div class="main-img js-product-slider">
                                <a href="#" class="hover-images effect"><img src="/public/assets/images/product/{{$product->image}}" alt="photo" class="img-responsive"></a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="single-product-info product-info product-grid-v2">
                        <h3 class="product-title"><a href="#">{{$product->{'name_'.app()->getLocale()} }}</a></h3>
                        <div class="product-price">
                            @if(!\Illuminate\Support\Facades\Auth::guest())

                                <span>{{$product->price}} Azn</span>
                            @endif
                        </div>

                        <div class="short-desc">
                            {!! $product->{'detail_'.app()->getLocale()} !!}
                        </div>


                        <div class="single-product-button-group">
                            <div class="flex align-items-center element-button">

                                <a  class="add-to-cart zoa-btn zoa-addcart" data-id="{{$product->id}}" data-price="{{$product->price}}" data-name_az="{{$product->name_az}}" data-name_en="{{$product->name_en}}" data-name_ru="{{$product->name_ru}}" data-name_tr="{{$product->name_tr}}" data-image="{{$product->image}}">
                                    <i class=" zoa-icon-cart" ></i>{{ trans('lang.add to cart') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="single-product-tab bd-bottom">-->
        <!--    <ul class="tabs text-center">-->
        <!--        <li class="active"><a data-toggle="pill" href="#review">Reviews </a></li>-->
        <!--    </ul>-->
        <!--    <div class="tab-content">-->
        <!--        <div id="review" class="tab-pane fade in active ">-->
        <!--            <ul class="review-content">-->
        <!--                <li class="element-review">-->
        <!--                    <p class="r-name">Felix Nguyen</p>-->
        <!--                    <p class="r-date">25, March 2018</p>-->

        <!--                    <p class="r-desc">-->
        <!--                        Free shipping on orders over 150€ within Europe and North America. Place your order today and receive it within 48 hours. And now, free and easy returns within Europe.-->
        <!--                    </p>-->
        <!--                </li>-->
        <!--                <li class="element-review">-->
        <!--                    <p class="r-name">Felix Nguyen</p>-->
        <!--                    <p class="r-date">25, March 2018</p>-->

        <!--                    <p class="r-desc">-->
        <!--                        Free shipping on orders over 150€ within Europe and North America. Place your order today and receive it within 48 hours. And now, free and easy returns within Europe.-->
        <!--                    </p>-->
        <!--                </li>-->
        <!--            </ul>-->
        <!--            @if(\Illuminate\Support\Facades\Auth::check())-->
        <!--                <div class="review-form">-->

        <!--                <div class="cmt-form">-->
        <!--                    <div class="form-group">-->
        <!--                        <div class="row">-->
        <!--                            <div class="col-md-6 col-sm-6 col-xs-12">-->
        <!--                                <input type="hidden" id="name" class="form-control" name="comment[name]" value="" placeholder="Name *">-->
        <!--                            </div>-->
        <!--                            <div class="col-md-6 col-sm-6 col-xs-12">-->
        <!--                                <input type="hidden" id="email" class="form-control" name="comment[email]" value="" placeholder="Phone Number">-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="form-group">-->
        <!--                        <div class="row">-->
        <!--                            <div class="col-md-12">-->
        <!--                                <textarea id="message" class="form-control" name="comment[body]" rows="9" placeholder="Your reviews"></textarea>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="form-group text-center">-->
        <!--                        <button type="submit" class="zoa-btn">-->
        <!--                            Submit-->
        <!--                        </button>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            @endif-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- EndContent -->
    </div>


@endsection
