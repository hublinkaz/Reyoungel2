@extends('staff.layouts.simple.master')
@section('title', 'Edit Profile')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Edit Profile') }}</h3>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">

                <div class="col-xl-8">
                    <form class="card" action="{{ route('staff.query.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media">
{{--                                        <img class="img-70 rounded-circle" alt="image" src="/assets/images/avtar/{{$account->image}}">--}}

                                        <div class="media-body">
                                            <h3 class="mb-1">{{$product->first_name}} {{$product->last_name}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ trans('lang.Status') }}</label>
                                        <select required id="status" name="status" class="form-control"  title="Select Status...">
                                            <option  value="0">{{ trans('lang.Deactivate') }} </option>
                                            <option  value="1">{{ trans('lang.Active') }} </option>
                                            <option  value="2">{{ trans('lang.Cancel') }} </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ trans('lang.Product') }}</label>
                                        <input class="form-control" type="text" placeholder="First Name" name="product_id" disabled id="product_id" value="{{$product->{'name_'.app()->getLocale()} }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ trans('lang.Qty') }}</label>
                                        <input class="form-control" type="number" placeholder="qty" name="qty"  id="qty" value="{{$product->qty}}">
                                    </div>
                                </div>
                                    <input class="" type="hidden" name="id" value="{{$product->id}}">
                                    <input class="" type="hidden" name="manager_id" value="{{$product->manager_id}}">
                                    <input class="" type="hidden" name="product_id" value="{{$product->product_id}}">
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">{{ trans('lang.Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
