@extends('admin.layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Default Forms</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ trans('lang.Form Layout) }}</li>
    <li class="breadcrumb-item active">{{ trans('lang.Default Forms) }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }}</label>
                                        <input class="form-control"  type="text" value="{{ $product->{'name_'.app()->getLocale()}   }}" name="name" placeholder="{{ trans('lang.Enter Name) }}"><small class="form-text text-muted" >{{ trans('lang.We well never share your email with anyone else.') }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Qty') }}</label>
                                        <input class="form-control" type="text" name="qty" value="{{ $product->qty }}" placeholder="Enter Qty"><small class="form-text text-muted" id="emailHelp">{{ trans('lang.We well never share your email with anyone else.') }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Price') }}</label>
                                        <input class="form-control" type="text" name="price" value="{{ $product->price }}" placeholder="Enter Price"><small class="form-text text-muted" id="emailHelp">{{ trans('lang.We well never share your email with anyone else.') }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }}</label>
                                        <textarea class="form-control btn-square" id="detail"  name="detail">{{ $product->detail }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.image') }}</label>
                                        <input id="image" name="image" class="input-file" type="file" value="{{ $product->image }}" accept="image/*">
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
