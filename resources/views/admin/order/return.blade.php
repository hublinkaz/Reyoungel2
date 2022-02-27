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
    <h3>{{ trans('lang.Return List') }}</h3>
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
                                    <th>İD</th>
                                    <th>{{ trans('lang.Manager') }}</th>
                                    <th>{{ trans('lang.Doctor') }}</th>
                                    <th>{{ trans('lang.Product') }}</th>

                   <th>{{ trans('lang.Action') }}</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td><a href="/admin-panel/orders/detail/{{$product->order_id}}">{{$product->order_id}}</a></td>
                                        <td>{{ $product->manager_first_name }} {{ $product->manager_last_name }}</td>
                                        <td>{{ $product->doctor_first_name }} {{ $product->doctor_last_name }}</td>
                                        <td>{{ $product->product_name }}</td>

                                        <td>
                                            <form action="{{ route('return.post.query') }}" method="POST">
                                                @csrf
                                                <select  style="color:#FF6800" required id="value" name="value" class="form-control" >
                                                            <option selected value="1">{{ trans('lang.Return') }}</option>
                                                            <option value="2">{{ trans('lang.Cancel') }}</option>

                                                </select>

                                                <input  type="hidden"  name="order_id" id="order_id" value="{{$product->order_id}}" >
                                                <input  type="hidden"  name="order_detail_id" id="order_detail_id" value="{{$product->order_detail_id}}" >
                                                <input  type="hidden"  name="product_id" id="product_id" value="{{$product->product_id}}" >
                                                <input  type="hidden"  name="manager_id" id="manager_id" value="{{$product->manager_id}}" >
                                                <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs">{{ trans('lang.Approval') }}</button>
                                            </form>

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
