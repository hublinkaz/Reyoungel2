@extends('layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Slider Yarat </h3>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="{{ route('slide.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Button Text') }}</label>
                                    <input class="form-control"  type="text" name="button_text" placeholder="Button Text"><small class="form-text text-muted" >We'll never share your email with anyone else.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Button link') }}</label>
                                    <input class="form-control"  type="text" name="button_link" placeholder="Button link"><small class="form-text text-muted" >We'll never share your email with anyone else.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Text') }}</label>
                                    <textarea class="form-control btn-square" id="text" name="text"></textarea>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
