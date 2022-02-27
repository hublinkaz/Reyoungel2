@extends('layouts.simple.master')
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

                        <form  action="{{ route('front.doctors.store') }}" method="POST" enctype="multipart/form-data">
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
                                <input class="form-control"  type="text" name="name" placeholder="{{ trans('lang.Enter Name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Phone') }}</label>
                                <input class="form-control" type="text" name="phone" placeholder="{{ trans('lang.Phone') }}">
                            </div>


                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.WorkPlace') }}</label>
                                <input class="form-control" type="text" name="workplace" placeholder="{{ trans('lang.WorkPlace') }}">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.location') }}</label>
                                <input class="form-control" type="text" name="location" placeholder="{{ trans('lang.location') }}">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Video') }}</label>
                                <input class="form-control" type="text" name="video_url" placeholder="{{ trans('lang.Video') }}"><small class="form-text text-muted" id="emailHelp">https://www.youtube.com/watch?v=<span style="color:#000000">g6xvHG8nd5U</span>&list=RDg6xvHG8nd5U&start_radio=1</small>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }}</label>
                                <textarea class="form-control btn-square" id="detail" name="text"></textarea>
                            </div>
                            <div class="user-image mb-3 text-center">
                                <div class="imgPreview"> </div>
                            </div>

                            <div class="custom-file">
                                <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple">
                                <label class="custom-file-label" for="images">{{ trans('lang.Choose image') }}</label>
                            </div>

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
