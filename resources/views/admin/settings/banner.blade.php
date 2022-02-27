@extends('admin.layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Add Doctor') }}</h3>
@endsection

@section('breadcrumb-items')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <!doctype html>
                    <html lang="en">

                    <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
                        <style>
                            .container {
                                max-width: 500px;
                            }
                            dl, ol, ul {
                                margin: 0;
                                padding: 0;
                                list-style: none;
                            }
                            .imgPreview img {
                                padding: 8px;
                                max-width: 100px;
                            }
                        </style>
                    </head>

                    <body>

                    <div class="container mt-5">

                        <form  action="{{ route('front.banner.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Text') }} AZ</label>
                                <input class="form-control"  type="text" name="text_az" value="{{$banner->text_az}}" placeholder="{{ trans('lang.Text') }}">
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Text') }} EN</label>
                                <input class="form-control"  type="text" name="text_en" value="{{$banner->text_en}}" placeholder="{{ trans('lang.Text') }}">
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Text') }} RU</label>
                                <input class="form-control"  type="text" name="text_ru" value="{{$banner->text_ru}}" placeholder="{{ trans('lang.Text') }}">
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Text') }} TR</label>
                                <input class="form-control"  type="text" name="text_tr" value="{{$banner->text_tr}}" placeholder="{{ trans('lang.Text') }}">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Url') }}</label>
                                <input class="form-control"  type="text" name="url" value="{{$banner->url}}" placeholder="{{ trans('lang.Url') }}">
                            </div>



                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.image') }}</label>
                                <input id="image" name="image" class="input-file" type="file" accept="image/*">
                            </div>


                            <input  type="hidden" name="id" value="{{$banner->id}}" >


                            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                {{ trans('lang.Submit') }}
                            </button>
                        </form>
                    </div>

                    <!-- jQuery -->

                    </body>
                    </html>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
