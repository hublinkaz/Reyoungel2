@extends('manager.layouts.simple.master')
@section('title', 'HTML 5 Data Export')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')

    <h3>{{ trans('lang.Total') }}</h3>
    <h3>{{ $total}} Azn</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ trans('lang.Home') }}</li>
    <li class="breadcrumb-item active">{{ trans('lang.Products') }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div class="dt-ext table-responsive">
                            <table class="display" id="export-button">

                                <thead>
                                <tr>
                                    <th>{{ trans('lang.Image') }}</th>
                                    <th>{{ trans('lang.Name') }}</th>
                                    <th>{{ trans('lang.Price') }}</th>
                                    <th>{{ trans('lang.Qty') }}</th>
                                    <th>{{ trans('lang.Discount') }}</th>
                                    <th>{{ trans('lang.Date') }}</th>
                                    <th>{{ trans('lang.Action') }}</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($products as $product)
                                    <tr>
                                        <td><img style="width: 50px" src="/public/assets/images/product/{{ $product->image }}" alt="">
                                        </td>
                                        <td><a >{{ $product->{'name_'.app()->getLocale()}   }}</a></td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->qty}}</td>
                                        <td>{{ $product->discount}}</td>
                                        <td>{{ $product->created_at}}</td>
                                        <td>
                                            <form action="{{ route('warehouse.return',$product->id) }}" method="POST">
                                                @csrf

                                                <input  type="number"  name="qty" id="qty" value="0" >
                                                <input  type="hidden"  name="product_id" id="product_id" value="{{$product->id}}" >
                                                <input  type="hidden"  name="manager_id" id="manager_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" >
                                                <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs">Qaytar</button>

                                            </form>


                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('lang.Image') }}</th>
                                    <th>{{ trans('lang.Name') }}</th>
                                    <th>{{ trans('lang.Price') }}</th>
                                    <th>{{ trans('lang.Qty') }}</th>
                                    <th>{{ trans('lang.Discount') }}</th>
                                    <th>{{ trans('lang.Date') }}</th>

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
