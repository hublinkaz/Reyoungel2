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

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="{{ route('page.edit.post',$page->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Title') }} AZ</label>
                                    <input class="form-control"  type="text" value="{{ $page->title_az }}" name="title_az" placeholder="Enter Name AZ">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Title') }} EN</label>
                                    <input class="form-control"  type="text" value="{{ $page->title_en }}" name="title_en" placeholder="Enter Name EN">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Title') }} RU</label>
                                    <input class="form-control"  type="text" value="{{ $page->title_ru }}" name="title_ru" placeholder="Enter Name RU">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Title') }} TR</label>
                                    <input class="form-control"  type="text" value="{{ $page->title_tr }}" name="title_tr" placeholder="Enter Name TR">
                                </div>



                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} AZ</label>
                                    <textarea class="form-control btn-square" id="body_az"  name="body_az">{{ $page->body_az }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} EN</label>
                                    <textarea class="form-control btn-square" id="body_en"  name="body_en">{{ $page->body_en }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} RU</label>
                                    <textarea class="form-control btn-square" id="body_ru"  name="body_ru">{{ $page->body_ru }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} TR</label>
                                    <textarea class="form-control btn-square" id="body_tr"  name="body_tr">{{ $page->body_tr }}</textarea>
                                </div>




                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ trans('lang.Submit') }}</button>
                                </div>
                            </form>
                        </div>
                        <script>
                            tinymce.init({
                                selector: '#body_az',
                            });
                            tinymce.init({
                                selector: '#body_en',
                            });
                            tinymce.init({
                                selector: '#body_ru',
                            });
                            tinymce.init({
                                selector: '#body_tr',
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
