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
                                    <th>{{ trans('lang.Manager') }}</th>
                                    <th>{{ trans('lang.Product') }}</th>

                                    <th>{{ trans('lang.Qty') }}</th>

                   <th>{{ trans('lang.Action') }}</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($returns as $return)
                                    <tr>
                                        <td><a href="{{route('manager.warehouse',$return->manager_id)}}">{{ $return->first_name }} {{ $return->last_name }}</a></td>
                                        <td>{{ $return->name_az }}</td>
                                        <td>{{ $return->qty }} </td>

                                        <td>
                                            <form action="{{ route('manager.return.product.update') }}" method="POST">
                                                @csrf
                                                <select  style="color:#FF6800" required id="value" name="value" class="form-control" >
                                                            <option selected value="1">{{ trans('lang.Return') }}</option>
                                                            <option value="2">{{ trans('lang.Cancel') }}</option>

                                                </select>


                                                <input  type="hidden"  name="return" id="return" value="{{$return->id}}" >
                                                <input  type="hidden"  name="manager_id" id="manager_id" value="{{$return->manager_id}}" >
                                                <input  type="hidden"  name="product_id" id="product_id" value="{{$return->product_id}}">
                                                <input  type="hidden"  name="qty" id="qty" value="{{$return->qty}}">
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
