@extends('admin.layouts.simple.master')
@section('title', 'Product list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">
@endsection

@section('style')
@endsection



@section('content')
    @if (\Illuminate\Support\Facades\Auth::user()->role_id==1 or \Illuminate\Support\Facades\Auth::user()->role_id==3 )
    <div class="row">
        <div class="col-6">
            <div class="card o-hidden">
                <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                        <div class="media-body">
                            <span class="m-0">{{ trans('lang.Count') }}</span>

                            <h4 class="mb-0 counter">{{$total[0]->qty}}</h4>
                            <i class="icon-bg" data-feather="shopping-bag"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card o-hidden">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="trending-up"></i></div>
                        <div class="media-body">
                            <span class="m-0">{{ trans('lang.Price') }}</span>
                            <h4 class="mb-0 ">
                                {{$total[0]->price}} ₼
                            </h4>
                            <i class="icon-bg" data-feather="star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('lang.Warehouse') }}</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa-spin fa-cog"></i></li>
                            <li><i class="view-html fa fa-code"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                            <li><i class="icofont icofont-error close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-status table-responsive">
                        <table class="table table-bordernone">
                            <thead>
                            <tr>
                                <th scope="col">{{ trans('lang.Name') }}</th>
                                <th scope="col">{{ trans('lang.Qty') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $products as $product)

                                <tr>
                                    <td class="f-w-600">{{$product->name_az }}</td>

                                    <td>
                                        <div class="span badge rounded-pill pill-badge-secondary">
                                            {{$product->qty}}
                                        </div>
                                    </td>

                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('lang.All Products') }}</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa-spin fa-cog"></i></li>
                            <li><i class="view-html fa fa-code"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                            <li><i class="icofont icofont-error close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-status table-responsive">
                        <table class="table table-bordernone">
                            <thead>
                            <tr>
                                <th scope="col">{{ trans('lang.Name') }}</th>
                                <th scope="col">{{ trans('lang.Qty') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $news as $new)

                                <tr>
                                    <td class="f-w-600">{{$new->{'name_'.app()->getLocale()} }}</td>

                                    <td>
                                        <div class="span badge rounded-pill pill-badge-secondary">
                                            {{$new->qty}}
                                        </div>
                                    </td>

                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        </div>
    @endif
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('assets/js/rating/rating-script.js')}}"></script>
    <script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('assets/js/ecommerce.js')}}"></script>
    <script src="{{asset('assets/js/product-list-custom.js')}}"></script>
@endsection
