@extends('admin.layouts.simple.master')
@section('title', 'Product list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Gift List') }}</h3>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>{{ trans('lang.id') }}</th>
                                    <th>{{ trans('lang.Doctor') }}</th>
                                    <th>{{ trans('lang.Product') }}</th>
                                    <th>{{ trans('lang.Manager') }}</th>
                                    <th>{{ trans('lang.Gift by') }}</th>

                                    <th>{{ trans('lang.History') }}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($gifts as $gift)
                                    <tr>
                                        <td><a >{{$gift->gift_id}}</a></td>
                                        <td><a >{{ $gift->doctor_first_name }} {{ $gift->doctor_last_name }}</a></td>
                                        <td><a >{{ $gift->{'name_'.app()->getLocale()}  }}</a></td>
                                        <td><a >{{ $gift->manager_first_name }} {{ $gift->manager_last_name }}</a></td>
                                        <td><a >{{ $gift->seller_first_name }} {{ $gift->seller_last_name }}</a></td>
                                        <td><a >{{ $gift->create_at }}</a></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('assets/js/rating/rating-script.js')}}"></script>
    <script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('assets/js/ecommerce.js')}}"></script>
    <script src="{{asset('assets/js/product-list-custom.js')}}"></script>
@endsection
