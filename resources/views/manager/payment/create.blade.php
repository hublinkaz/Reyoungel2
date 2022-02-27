@extends('manager.layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Default Forms</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Form Layout</li>
    <li class="breadcrumb-item active">Default Forms</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h4>{{ trans('lang.Add Payment') }}</h4>
                                <p>Enter your Doctor Payment</p>



                                <div class="form-group">
                                    <label>{{trans('lang.Order')}} *</label>
                                    <select required id="order_detail_id" name="order_detail_id" class="form-control"  title="Select Order...">
                                        @foreach($payments as $payment)
                                            @if ($payment->amount > $payment->doctor_paid)
                                                <option value="{{$payment->od_id}}">{{$payment->od_id}} | {{$payment->{'product_name_'.app()->getLocale()}  }}| {{$payment->doctor_first_name}} | {{$payment->amount}} | {{$payment->doctor_paid}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Paid</label>
                                    <input class="form-control" type="text" id="paid" name="paid" required="" placeholder="Paid">

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
