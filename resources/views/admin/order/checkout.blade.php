@extends('admin.layouts.simple.master')
@section('title', 'Checkout')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Checkout') }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ trans('lang.Ecommerce') }}</li>
    <li class="breadcrumb-item active">{{ trans('lang.Checkout') }}</li>
@endsection

@section('content')
    <div class="container-fluid checkout">
        <div class="card">
            <div class="card-header">
                <h5>{{ trans('lang.Billing Details') }}</h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="checkout-details">
                        <div class="order-box">
                            <div class="title-box">
                                <div class="checkbox-title">
                                    <h4>{{ trans('lang.Product') }} </h4>
                                    <span>{{ trans('lang.Total') }}</span>
                                </div>
                            </div>
                            <ul class="show-cart qty">

                            </ul>


                            <ul class="sub-total total">
                                {{--                                    <li>Total <span class="total-cart count"></span></li>--}}
                                <li > <span>{{ trans('lang.TOTAL') }} : &emsp;&emsp; </span> <span class="total-cart "> </span>₼</li>

                            </ul>
{{--                            <div class="animate-chk">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col">--}}
{{--                                        <label class="d-block" for="edo-ani">--}}
{{--                                            <input class="radio_animated" id="edo-ani" type="radio" name="rdo-ani" checked="" data-original-title="" title="">Deposit--}}
{{--                                        </label>--}}
{{--                                        <label class="d-block" for="edo-ani1">--}}
{{--                                            <input class="radio_animated" id="edo-ani1" type="radio" name="rdo-ani" data-original-title="" title="">Şatış--}}
{{--                                        </label>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <br>
                          <form action="#">
                           {{csrf_field()}}
{{--                            <div class="mb-3">--}}

{{--                                <label for="doctor">{{ trans('lang.Doctor') }}</label>--}}
{{--                                <select required name="doctorid" required id="doctorid" class="form-control" title="Select customer...">--}}


{{--                                    @foreach($doctors as $doctor)--}}

{{--                                        <option value="{{$doctor->id}}">{{$doctor->first_name . ' (' . $doctor->phone . ')'}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}

{{--                            </div>--}}

                            <label for="location"></label><textarea name="location" required id="location" placeholder="Your location" class="form-control btn-square" ></textarea>

                            <div class="order-place">
                                <a class="checkout_post btn btn-primary" >{{ trans('lang.Approval') }}  </a>
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
