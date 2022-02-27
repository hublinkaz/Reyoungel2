@extends('staff.layouts.simple.master')
@section('title', 'Product list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Product list') }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ trans('lang.Ecommerce') }}</li>
    <li class="breadcrumb-item active">{{ trans('lang.Product list') }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        @if (\Illuminate\Support\Facades\Auth::user()->role_id==1 or \Illuminate\Support\Facades\Auth::user()->role_id ==3)
            <a class="btn btn-outline-secondary-2x" href="/staff-panel/order/driver/{{$id}}">{{ trans('lang.Driver Assignment') }}</a>

        @endif

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>{{ trans('lang.Details') }}</th>
                                    <th>{{ trans('lang.Name') }}</th>
                                    <th>{{ trans('lang.Paid') }}</th>
                                    <th>{{ trans('lang.Doctor Paid Date') }}</th>

                                    <th>{{ trans('lang.Sale Date') }}</th>
                   <th>{{ trans('lang.Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    @if($product->price===0)
                                        <tr>
                                            <td><img style="width: 50px" src="/public/assets/images/product/{{ $product->image }}" alt=""></td>
                                            <td>
                                                <h6 style="color:green"> {{ $product->{'name_'.app()->getLocale()}   }} </h6>
                                                <span style="color:green">{{ trans('lang.Gift') }}</span>
                                            </td>
                                            <td><span style="color:green">{{ trans('lang.Gift') }}</span></td>

                                            <td class="font-success">{{ $product->order_details_paid }}</td>
                                            <td class="font-success">{{ $product->order_detail_created }}</td>
                                            <td>
                                                <form action="{{ route('staff.return.post',$product->order_details_id) }}" method="POST">
                                                    @csrf
                                                    @if($product->is_return===0)
                                                        <select style="color:#1100FF" required id="is_return" name="is_return" class="form-control"  title="Select Manager...">

                                                            <option selected value="0">{{ trans('lang.Sales') }}</option>
                                                            <option  value="1">{{ trans('lang.Return') }}</option>

                                                        </select>
                                                    @elseif($product->is_return===1)
                                                        <select style="color:#FF6800" required id="is_return" name="is_return" class="form-control"  title="Select Manager...">

                                                            <option  value="0">{{ trans('lang.Sales') }}</option>
                                                            <option selected value="1">{{ trans('lang.Return') }}</option>


                                                        </select>
                                                    @endif

                                                    <input  type="hidden"  name="order_details_id" id="order_details_id" value="{{$product->order_details_id}}" >


                                                    <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs">{{ trans('lang.Change') }}</button>
                                                </form>

                                            </td>


                                        </tr>
                                    @else
                                        <tr>
                                            <td><img style="width: 50px" src="/public/assets/images/product/{{ $product->image }}" alt=""></td>
                                            <td>
                                                <h6> {{ $product->{'name_'.app()->getLocale()}   }} </h6>
                                                <span>{{ $product->price }} ₼</span>
                                            </td>
                                            <td>{{ $product->paid }}</td>

                                            <td class="font-success">{{ $product->order_details_paid }}</td>
                                            <td class="font-success">{{ $product->order_detail_created }}</td>

                                            <td>
                                                <form action="{{ route('staff.return.post',$product->order_details_id) }}" method="POST">
                                                    @csrf
                                                    @if($product->is_return===0)
                                                        <select style="color:#1100FF" required id="is_return" name="is_return" class="form-control"  title="Select Manager...">

                                                            <option selected value="0">{{ trans('lang.Sales') }}</option>
                                                            <option  value="1">{{ trans('lang.Return') }}</option>
                                                        </select>
                                                    @elseif($product->is_return===1)
                                                        <select style="color:#FF6800" required id="is_return" name="is_return" class="form-control"  title="Select Manager...">

                                                            <option  value="0">{{ trans('lang.Sales') }}</option>
                                                            <option selected value="1">{{ trans('lang.Return') }}</option>

                                                        </select>
                                                    @endif

                                                    <input  type="hidden"  name="order_details_id" id="order_details_id" value="{{$product->order_details_id}}" >


                                                    <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs">{{ trans('lang.Change') }}</button>
                                                </form>

                                            </td>


                                        </tr>

                                    @endif


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
