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

                        <form  action="{{ route('setting.edit.post') }}" method="POST" enctype="multipart/form-data">
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
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }}</label>
                                <input class="form-control"  type="text" name="name" value="{{$setting->name}}" placeholder="{{ trans('lang.Enter Name') }}">
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }}</label>
                                <input class="form-control"  type="text" name="key" value="{{$setting->key}}" placeholder="{{ trans('lang.Enter Name') }}">
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }}</label>
                                <input class="form-control"  type="text" name="value" value="{{$setting->value}}" placeholder="{{ trans('lang.Enter Name') }}">
                            </div>




                            <input class="form-control" type="hidden" name="id" value="{{$setting->id}}" >

                            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                {{ trans('lang.Submit') }}
                            </button>
                        </form>
                    </div>

                    <!-- jQuery -->
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script>
                        $(function() {
                            // Multiple images preview with JavaScript
                            var multiImgPreview = function(input, imgPreviewPlaceholder) {

                                if (input.files) {
                                    var filesAmount = input.files.length;

                                    for (i = 0; i < filesAmount; i++) {
                                        var reader = new FileReader();

                                        reader.onload = function(event) {
                                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                                        }

                                        reader.readAsDataURL(input.files[i]);
                                    }
                                }

                            };

                            $('#images').on('change', function() {
                                multiImgPreview(this, 'div.imgPreview');
                            });
                        });
                        tinymce.init({
                            selector: '#detail'
                        });
                    </script>
                    </body>
                    </html>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
