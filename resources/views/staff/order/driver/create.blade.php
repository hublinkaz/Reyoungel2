@extends('staff.layouts.simple.master')
@section('title', 'Edit Profile')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Driver Assignment')}}</h3>
@endsection

@section('breadcrumb-items')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">

                <div class="col-xl-8">
                    <form class="card" action="{{ route('order.driver.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{ trans('lang.Drivers')}} </label>
                                            <select required id="driver_id" name="driver_id" class="form-control"  title="Select Manager...">
                                                @foreach($drivers as $driver)
                                                    @if ($driver->user_id==$order->driver_id)
                                                        <option selected value="{{$driver->user_id}}">{{$driver->first_name}}  {{$driver->last_name}} </option>
                                                    @else
                                                        <option value="{{$driver->user_id}}">{{$driver->first_name}}  {{$driver->last_name}} </option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input class="" type="hidden" name="id" value="{{$order->id}}">
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">{{ trans('lang.Approval')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
