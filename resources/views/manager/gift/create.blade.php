@extends('manager.layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Make a gift') }}</h3>
@endsection

@section('breadcrumb-items')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="{{ route('manager.gift.post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h4>{{ trans('lang.Make a gift') }}</h4>
{{--                                <p>Enter your Doctor Payment</p>--}}



                                <div class="form-group">
                                    <label>{{trans('lang.Orders')}} *</label>
                                    <select required id="order_id" name="order_id" class="form-control"  title="Select Order...">
                                        <option>Sifariş id seç</option>

                                    @foreach($orders as $order)

                                                <option value="{{$order->id}}">{{ trans('lang.Order id') }}: {{$order->id}}  </option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{trans('lang.Product')}} *</label>
                                    <select required id="product_id" name="product_id" class="form-control"  title="Select Product...">
                                        <option>{{ trans('lang.Product') }}</option>

                                    @foreach($products as $product)

                                            <option value="{{$product->product_id}}">{{$product->{'name_'.app()->getLocale()} }} </option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ trans('lang.Submit') }}</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
