@extends('staff.layouts.simple.master')
@section('title', 'Product')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/range-slider.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Product</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Ecommerce</li>
    <li class="breadcrumb-item active">Product</li>
@endsection

@section('content')
    <div class="container-fluid product-wrapper">
        <div class="product-grid">
            <div class="product-wrapper-grid">
                <div class="feature-products">
                                <div class="row">
                                    <div class="col-md-6 products-total">
                                        <div class="square-product-setting d-inline-block"><a class="icon-grid grid-layout-view" href="#" data-original-title="" title=""><i data-feather="grid"></i></a></div>
                                        <div class="square-product-setting d-inline-block"><a class="icon-grid m-0 list-layout-view" href="#" data-original-title="" title=""><i data-feather="list"></i></a></div>
                                        <span class="d-none-productlist filter-toggle">
                               Filters<span class="ms-2"><i class="toggle-data" data-feather="chevron-down"></i></span></span>
                                        <div class="grid-options d-inline-block">
                                            <ul>
                                                <li><a class="product-2-layout-view" href="#" data-original-title="" title=""><span class="line-grid line-grid-1 bg-primary"></span><span class="line-grid line-grid-2 bg-primary"></span></a></li>
                                                <li><a class="product-3-layout-view" href="#" data-original-title="" title=""><span class="line-grid line-grid-3 bg-primary"></span><span class="line-grid line-grid-4 bg-primary"></span><span class="line-grid line-grid-5 bg-primary"></span></a></li>
                                                <li><a class="product-4-layout-view" href="#" data-original-title="" title=""><span class="line-grid line-grid-6 bg-primary"></span><span class="line-grid line-grid-7 bg-primary"></span><span class="line-grid line-grid-8 bg-primary"></span><span class="line-grid line-grid-9 bg-primary"></span></a></li>
                                                <li><a class="product-6-layout-view" href="#" data-original-title="" title=""><span class="line-grid line-grid-10 bg-primary"></span><span class="line-grid line-grid-11 bg-primary"></span><span class="line-grid line-grid-12 bg-primary"></span><span class="line-grid line-grid-13 bg-primary"></span><span class="line-grid line-grid-14 bg-primary"></span><span class="line-grid line-grid-15 bg-primary"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-xl-3 col-sm-6 xl-4">
                        <div class="card">
                            <div class="product-box">
                                <div class="product-img">
                                    <img class="img-fluid" src="/public/assets/images/product/{{ $product->image }}" alt="">
                                    <div class="product-hover">
                                        <ul>
                                            <li>
                                                <button class="add-to-cart btn" type="button" data-id="{{$product->id}}" data-price="{{$product->price}}" data-name_az="{{$product->name_az}}" data-name_en="{{$product->name_en}}" data-name_ru="{{$product->name_ru}}" data-name_tr="{{$product->name_tr}}" data-image="{{$product->image}}"><i class="icon-shopping-cart"></i></button>
                                            </li>
{{--                                            <li>--}}
{{--                                                <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter2"><i class="icon-eye"></i></button>--}}
{{--                                            </li>--}}

                                        </ul>
                                    </div>
                                </div>
{{--                                <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter2" aria-hidden="true">--}}
{{--                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">--}}
{{--                                        <div class="modal-content">--}}
{{--                                            <div class="modal-header">--}}
{{--                                                <div class="product-box row">--}}
{{--                                                    <div class="product-img col-lg-6"><img class="img-fluid" src="/public/assets/images/product/{{ $product->image }}" alt=""></div>--}}
{{--                                                    <div class="product-details col-lg-6 text-start">--}}
{{--                                                        <h4>{{ $product->{'name_'.app()->getLocale()}   }}</h4>--}}
{{--                                                        <div class="product-price">{{ $product->price }} ₼--}}
{{--                                                        </div>--}}
{{--                                                        <div class="product-view">--}}
{{--                                                            <h6 class="f-w-600">Product Details</h6>--}}
{{--                                                            <p>{!! \Illuminate\Support\Str::limit($product->{'detail_'.app()->getLocale()}  , 50, ' ...') !!}</p>--}}

{{--                                                            <p class="mb-0">{{ $product->{'detail_'.app()->getLocale()}   }}</p>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="product-qnty">--}}
{{--                                                            <h6 class="f-w-600">Quantity</h6>--}}
{{--                                                            <fieldset>--}}
{{--                                                                <div class="input-group">--}}
{{--                                                                    <input class="touchspin text-center" type="text" value="5">--}}
{{--                                                                </div>--}}
{{--                                                            </fieldset>--}}
{{--                                                            <div class="addcart-btn">--}}
{{--                                                                <button class="btn btn-primary" type="button">Add to Cart</button>--}}
{{--                                                                <button class="btn btn-primary" type="button">View Details</button>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="product-details">
                                    <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                    <h4>{{ $product->{'name_'.app()->getLocale()}   }}</h4>
                                    <p>{!! \Illuminate\Support\Str::limit($product->{'detail_'.app()->getLocale()}  , 50, ' ...') !!}</p>

{{--                                    <p>{{ $product->{'detail_'.app()->getLocale()}   }}</p>--}}
                                    <div class="product-price"> {{ $product->price }} ₼

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/range-slider/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('assets/js/range-slider/rangeslider-script.js')}}"></script>
    <script src="{{asset('assets/js/touchspin/vendors.min.js')}}"></script>
    <script src="{{asset('assets/js/touchspin/touchspin.js')}}"></script>
    <script src="{{asset('assets/js/touchspin/input-groups.min.js')}}"></script>
    <script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('assets/js/product-tab.js')}}"></script>

@endsection
