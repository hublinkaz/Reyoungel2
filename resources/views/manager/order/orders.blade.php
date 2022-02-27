@extends('manager.layouts.simple.master')
@section('title', 'Product list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Sales List')}}</h3>
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
                                    <th>{{ trans('lang.İD')}}</th>
                                    <th>{{ trans('lang.Doctors')}}</th>
                                    <th>{{ trans('lang.Total')}}</th>
                                    <th>{{ trans('lang.Paid')}}</th>
                                    <th>{{ trans('lang.Will be Paid')}}</th>
                                    <th>{{ trans('lang.Date')}}</th>
                                    <th>{{ trans('lang.Status')}}</th>
                                    <th>{{ trans('lang.Qaimə')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td><a href="/manager-panel/orders/detail/{{$order->id}}">{{$order->id}}</a></td>
                                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                        <td>{{ round( $order->total,1) }} ₼ </td>
                                        <td>{{ round( $order->paid,1) }} ₼ </td>
                                        <td>{{ $order->total - $order->paid }} ₼ </td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->status_az }}</td>
                                        <td><a class="btn btn-success "  data-original-title="btn btn-danger btn-xs" href="{{ route('manager.order.invoice',$order->id) }}">{{ trans('lang.Report')}}</a>
                                        </td>

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
