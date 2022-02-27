@extends('admin.layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Default Forms') }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ trans('lang.Form Layout') }}</li>
    <li class="breadcrumb-item active">{{ trans('lang.Default Forms') }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="{{ route('products.update',$staff->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }}</label>
                                        <input class="form-control"  type="text" value="{{ $staff->name }}" name="name" placeholder="Enter Name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Qty') }}</label>
                                        <input class="form-control" type="text" name="qty" value="{{ $staff->qty }}" placeholder="Enter Qty">
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Price') }}</label>
                                        <input class="form-control" type="text" name="price" value="{{ $staff->price }}" placeholder="Enter Price">
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }}</label>
                                        <textarea class="form-control btn-square" id="detail"  name="detail">{{ $staff->detail }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.image') }}</label>
                                        <input id="image" name="image" class="input-file" type="file" value="{{ $staff->image }}" accept="image/*">
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
