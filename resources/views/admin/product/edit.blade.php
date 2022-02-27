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

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }} AZ</label>
                                        <input class="form-control"  type="text" value="{{ $product->name_az }}" name="name_az" placeholder="Enter Name AZ">
                                    </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }} EN</label>
                                    <input class="form-control"  type="text" value="{{ $product->name_en }}" name="name_en" placeholder="Enter Name EN">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }} RU</label>
                                    <input class="form-control"  type="text" value="{{ $product->name_ru }}" name="name_ru" placeholder="Enter Name RU">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">{{ trans('lang.Name') }} TR</label>
                                    <input class="form-control"  type="text" value="{{ $product->name_tr }}" name="name_tr" placeholder="Enter Name TR">
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
                                        <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} AZ</label>
                                        <textarea class="form-control btn-square" id="detail_az"  name="detail_az">{{ $product->detail_az }}</textarea>
                                    </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} EN</label>
                                    <textarea class="form-control btn-square" id="detail_en"  name="detail_en">{{ $product->detail_en }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} RU</label>
                                    <textarea class="form-control btn-square" id="detail_ru"  name="detail_ru">{{ $product->detail_ru }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.Desc') }} TR</label>
                                    <textarea class="form-control btn-square" id="detail_tr"  name="detail_tr">{{ $product->detail_tr }}</textarea>
                                </div>


                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.image') }}</label>
                                        <input id="image" name="image" class="input-file" type="file" value="{{ $product->image }}" accept="image/*">
                                    </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ trans('lang.Status') }}</label>
                                        <select required id="status" name="status" class="form-control"  title="Select Status...">

                                            @if ($product->status==0)
                                                <option selected value="0">{{ trans('lang.Deactivate') }} </option>
                                                <option  value="1">{{ trans('lang.Active') }} </option>


                                            @elseif ($product->status==1)
                                                <option  value="0">{{ trans('lang.Deactivate') }} </option>
                                                <option selected value="1">{{ trans('lang.Active') }} </option>
                                            @endif
                                        </select>
                                    </div>
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
