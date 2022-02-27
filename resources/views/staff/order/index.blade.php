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
                                    <th>{{ trans('lang.Doctor')}}</th>
                                    <th>{{ trans('lang.Manager')}}</th>
                                    <th>{{ trans('lang.Driver')}}</th>
                                    <th>{{ trans('lang.Action') }}</th>
                                    <th>{{ trans('lang.Date')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td><a href="/staff-panel/orders/detail/{{$product->order_id}}">{{$product->order_id}}</a></td>
                                        <td><a href="/staff-panel/doctor/{{$product->doctor_id}}">{{ $product->doctor_first_name }} {{ $product->doctor_last_name }}</a></td>
                                        <td><a href="/staff-panel/manager/{{$product->manager_id}}">{{ $product->manager_first_name }} {{ $product->manager_last_name }}</a></td>
                                        <td>{{ $product->driver_first_name }} {{ $product->driver_last_name }}</td>

                                        <td>
                                            <form action="{{ route('staff.order.status',$product->order_id) }}" method="POST">
                                                @csrf

                                                        <select  style="color:#FF6800" required id="is_delivered" name="is_delivered" class="form-control"  title="Select Manager...">
                                                            @if($product->is_delivered===0)
                                                            @endif
                                                            @foreach($status as $stat)
                                                                    @if($product->is_delivered===$stat->id)
                                                                        <option selected value="{{$stat->id}}">{{$stat->{'status_'.app()->getLocale()}  }}</option>
                                                                    @else
                                                                        <option value="{{$stat->id}}">{{$stat->{'status_'.app()->getLocale()}  }}</option>
                                                                    @endif

                                                                @endforeach

                                                        </select>






                                                <input  type="hidden"  name="order_id" id="order_id" value="{{$product->order_id}}" >

                                                @if(\Illuminate\Support\Facades\Auth::user()->role_id ==1 or \Illuminate\Support\Facades\Auth::user()->role_id ==3)

                                                     @if($product->is_delivered === 3)
                                                        <button type="submit" class="form-control btn btn-success btn-xs"  disabled data-original-title="btn btn-success btn-xs">{{ trans('lang.Change')}}</button>

                                                    @else
                                                        <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs">{{ trans('lang.Change')}}</button>
                                                    @endif
                                              @endif
                                            </form>

                                        </td>
                                        <td>{{ $product->order_created_at }}</td>

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
