@extends('admin.layouts.simple.master')
@section('title', 'HTML 5 Data Export')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')

    <h3>{{ trans('lang.Products') }}</h3>

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ trans('lang.Home') }}</li>
    <li class="breadcrumb-item active">{{ trans('lang.Products') }}</li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <h4>Toplam Borc : {{$total}} Azn</h4>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div class="dt-ext table-responsive">
                            <table class="display" id="export-button">

                                <thead>
                                <tr>
                                    <th>{{ trans('lang.id') }}</th>
                                    <th>{{ trans('lang.Image') }}</th>
                                    <th>{{ trans('lang.Name') }}</th>
                                    <th>{{ trans('lang.Count') }}</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($products as $product)
                                    <tr>
                                        <td><a href="{{route('manager.deposit.detail',['product_id'=>$product->id,'manager_id'=>$id])}}">{{$product->id}}</a></td>

                                        <td><img style="width: 50px" src="/public/assets/images/product/{{ $product->image }}" alt="">
                                        </td>
                                        <td><a >{{ $product->{'name_'.app()->getLocale()}  }}</a></td>
                                        <td>{{ $product->qty }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('lang.id') }}</th>
                                    <th>{{ trans('lang.Image') }}</th>
                                    <th>{{ trans('lang.Name') }}</th>
                                    <th>{{ trans('lang.Location') }}</th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/custom.js')}}"></script>
@endsection
