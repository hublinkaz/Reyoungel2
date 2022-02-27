@extends('staff.layouts.simple.master')
@section('title', 'HTML 5 Data Export')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')

    <h3>{{ trans('lang.Staffes') }}</h3>
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
                                    <th>{{ trans('lang.Phone Number') }}</th>
                                    <th>{{ trans('lang.Options') }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($staffes as $staff)
                                    <tr>
                                        <td><img style="width: 100px;filter: drop-shadow(0px 0px 1px rgb(0 0 1 / 0.4));" src="https://hublink.az/public/images/media/16247058921624655281logonew1.svg">
                                        </td>
                                        <td>{{ $staff->first_name }} {{ $staff->last_name }}</td>
                                        <td>{{ $staff->phone }}</td>
                                        <td>


                                                <a class="btn btn-primary" href="{{ route('staff.edit',$staff->id) }}">Edit</a>


                                            </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('lang.Image') }}</th>
                                    <th>{{ trans('lang.Name') }}</th>
                                    <th>{{ trans('lang.Phone Number') }}</th>
                                    <th>{{ trans('lang.Options') }}</th>

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
