@extends('layouts.simple.master')
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

                            <form class="theme-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }} AZ</label>
                                    <input class="form-control"  type="text" name="name_az" placeholder="Enter Name AZ">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }} EN</label>
                                    <input class="form-control"  type="text" name="name_en" placeholder="Enter Name EN">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }} RU</label>
                                    <input class="form-control"  type="text" name="name_ru" placeholder="Enter Name RU">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }} TR</label>
                                    <input class="form-control"  type="text" name="name_tr" placeholder="Enter Name TR">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Qty') }}</label>
                                    <input class="form-control" type="text" name="qty" placeholder="Enter Qty"><small class="form-text text-muted" id="emailHelp">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Price') }}</label>
                                    <input class="form-control" type="text" name="price" placeholder="Enter Price"><small class="form-text text-muted" id="emailHelp">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Cost') }}</label>
                                    <input class="form-control" type="number" name="cost" placeholder="Enter Cost"><small class="form-text text-muted" id="emailHelp">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Discount') }}</label>
                                    <input class="form-control" type="number" name="discount" placeholder="Enter Discount"><small class="form-text text-muted" id="emailHelp">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Units') }}</label>
                                    <input class="form-control" type="text" name="units" placeholder="Enter Units"><small class="form-text text-muted" id="emailHelp">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} AZ</label>
                                    <textarea class="form-control btn-square" id="detail_az" name="detail_az"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} EN</label>
                                    <textarea class="form-control btn-square" id="detail_en" name="detail_en"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} RU</label>
                                    <textarea class="form-control btn-square" id="detail_ru" name="detail_ru"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} TR</label>
                                    <textarea class="form-control btn-square" id="detail_tr" name="detail_tr"></textarea>
                                </div>


                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.image') }}</label>
                                    <input id="image" name="image" class="input-file" type="file" accept="image/*">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ trans('lang.Submit') }}</button>
                                </div>
                            </form>
                        </div>
                        <script>
                            tinymce.init({
                                selector: '#detail_az',
                            });
                            tinymce.init({
                                selector: '#detail_en',
                            });
                            tinymce.init({
                                selector: '#detail_ru',
                            });
                            tinymce.init({
                                selector: '#detail_tr',
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
