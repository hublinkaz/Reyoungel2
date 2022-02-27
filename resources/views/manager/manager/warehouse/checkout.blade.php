@extends('manager.layouts.simple.master')
@section('title', 'Checkout')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Checkout') }}</h3>
@endsection

@section('breadcrumb-items')

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

                                <li > <span>{{ trans('lang.TOTAL') }} : &emsp;&emsp; </span> <span class="total-cart "> </span>₼</li>

                            <br>
                                @if (Auth::user()->role_id==1 or Auth::user()->role_id==3)
                                    <form action="#">
                                        {{csrf_field()}}
                                        <div class="mb-3">

                                            <label for="doctorid">{{ trans('lang.Manager') }}</label>
                                            <select required name="doctorid" id="doctorid" class="form-control" title="Select customer...">

                                                @foreach($managers as $manager)

                                                    <option value="{{$manager->id}}">{{$manager->first_name . ' (' . $manager->phone . ')'}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <input class="form-control" type="hidden"  name="user" id="user" value="{{Auth::user()->id}}" >
                                        <input class="form-control" type="hidden"  name="role" id="role" value="2" >
                                        <input class="form-control" type="hidden"  name="pdf" id="pdf" value="{{time()}}" >
                                        <input class="form-control" type="hidden"  name="location" id="location" value="Manager" >


                                        {{--                                <label for="location"></label><textarea name="location" required id="location" placeholder="Your location" class="form-control btn-square" ></textarea>--}}

                                        <div class="order-place">
                                            <a class="checkout_post btn btn-primary" >{{ trans('lang.Require a product') }}  </a>
                                        </div>
                                    </form>
                                @elseif(Auth::user()->role_id==2)
                                    <form action="#">
                                        {{csrf_field()}}

                                        <input class="form-control" type="hidden"  name="doctorid" id="doctorid" value="{{Auth::user()->id}}" >

                                        <input class="form-control" type="hidden"  name="user" id="user" value="{{Auth::user()->id}}" >
                                        <input class="form-control" type="hidden"  name="role" id="role" value="2" >
                                        <input class="form-control" type="hidden"  name="pdf" id="pdf" value="{{time()}}" >
                                        <input class="form-control" type="hidden"  name="location" id="location" value="Manager" >


                                        {{--                                <label for="location"></label><textarea name="location" required id="location" placeholder="Your location" class="form-control btn-square" ></textarea>--}}

                                        <div class="order-place">
                                            <a class="checkout_post btn btn-primary" >{{ trans('lang.Require a product') }}  </a>
                                        </div>
                                    </form>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
