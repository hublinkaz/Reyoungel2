@extends('admin.layouts.simple.master')
@section('title', 'Product list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Pages') }}</h3>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>{{ trans('lang.Title') }}</th>
{{--                                    <th>{{ trans('lang.Key') }}</th>--}}
{{--                                    <th>{{ trans('lang.Amount') }}</th>--}}
{{--                                    <th>{{ trans('lang.Value') }}</th>--}}
                                    <th>{{ trans('lang.Action') }}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pages as $page)
                                <tr>

                                    <td class="font-success">{{ $page->title_az }}</td>
{{--                                    <td class="font-success">{{ $page->key }}</td>--}}
{{--                                    <td class="font-success">{{ $page->value }}</td>--}}


                                    <td>


                                            <a class="btn btn-success "  data-original-title="btn btn-danger btn-xs" href="{{ route('page.edit',$page->id) }}">{{ trans('lang.Edit') }}</a>



                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('assets/js/rating/rating-script.js')}}"></script>
    <script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('assets/js/ecommerce.js')}}"></script>
    <script src="{{asset('assets/js/product-list-custom.js')}}"></script>
@endsection
