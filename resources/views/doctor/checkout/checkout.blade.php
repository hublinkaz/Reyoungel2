@extends('layouts.simple.master')
@section('title', 'Checkout')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Checkout') }}</h3>
@endsection



@section('content')
    <div class="container-fluid checkout">
        <div class="card">
{{--            <div class="card-header">--}}
{{--                <h5>Billing Details</h5>--}}
{{--            </div>--}}
            <div class="card-body">
                <div class="row">

                    <div class="checkout-details">
                        <div class="order-box">
                            <div class="title-box">
                                <div class="checkbox-title">
                                    <h4>{{ trans('lang.Product') }}</h4>
                                    <span>{{ trans('lang.Total') }}</span>
                                </div>
                            </div>
                            <ul class="show-cart qty">

                            </ul>


                            <ul class="sub-total total">
                                <li > <span>{{ trans('lang.Total') }} : &emsp;&emsp; </span> <span class="total-cart "> </span>₼</li>

                            </ul>

                            <br>
                            <form action="#">
                                {{csrf_field()}}
                                <div class="mb-3">

                                    <label for="doctorid">{{ trans('lang.Doctor') }}</label>
                                    <select required name="doctorid" id="doctorid" class="form-control" title="Select customer...">

                                        @foreach($doctors as $doctor)

                                            <option value="{{$doctor->id}}">{{$doctor->first_name . ' (' . $doctor->phone . ')'}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <input class="form-control" type="hidden"  name="user" id="user" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" >
                                <input class="form-control" type="hidden"  name="user_role" id="user_role" value="{{Auth::user()->role_id}}" >
                                <input class="form-control" type="hidden"  name="role" id="role" value="5" >
                                <input class="form-control" type="hidden"  name="pdf" id="pdf" value="{{time()}}" >
                                <label for="location"></label><textarea name="location" required id="location" placeholder="Your location" class="form-control btn-square" ></textarea>

                                <div class="order-place">
                                    <a class="checkout_post btn btn-primary" >{{ trans('lang.Submit') }}  </a>
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
