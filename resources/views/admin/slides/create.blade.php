@extends('admin.layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Slider Yarat') }} </h3>
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
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Button Text') }} AZ</label>
                                    <input class="form-control"  type="text" name="button_text_az" placeholder="Button Text">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Button Text') }} EN</label>
                                    <input class="form-control"  type="text" name="button_text_en" placeholder="Button Text">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Button Text') }} RU</label>
                                    <input class="form-control"  type="text" name="button_text_ru" placeholder="Button Text">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Button Text') }} TR</label>
                                    <input class="form-control"  type="text" name="button_text_tr" placeholder="Button Text">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Button link') }}</label>
                                    <input class="form-control"  type="text" name="button_link" placeholder="Button link"><small class="form-text text-muted" ></small>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Text') }} AZ</label>
                                    <textarea class="form-control btn-square" id="text" name="text_az"></textarea>
                                </div>


                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Text') }} EN</label>
                                    <textarea class="form-control btn-square" id="text" name="text_en"></textarea>
                                </div>


                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Text') }} RU</label>
                                    <textarea class="form-control btn-square" id="text" name="text_ru"></textarea>
                                </div>


                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Text') }}TR</label>
                                    <textarea class="form-control btn-square" id="text" name="text_tr"></textarea>
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
