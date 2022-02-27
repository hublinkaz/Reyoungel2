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
    <h3>Anbar</h3>
@endsection


@section('content')
    @if (\Illuminate\Support\Facades\Auth::user()->role_id==1 or \Illuminate\Support\Facades\Auth::user()->role_id==3 )
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5>Anbar</h5>
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
                                    <td class="f-w-600">{{$product->{'name_'.app()->getLocale()} }}</td>

                                    @php
                                        foreach($managers as $manager){
                                            if($manager->product_id==$product->id){
                                                $product->qty=$product->qty+$manager->qty;
                                            }
                                        }

                                        foreach($doctors as $doctor){

                                            if ($doctor->product_id==$product->id and $doctor->amount > ($doctor->total)){
                                                $product->qty=$product->qty+1;
                                            }
                                        }
                                    @endphp
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
