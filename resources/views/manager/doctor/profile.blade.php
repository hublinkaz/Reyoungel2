@extends('manager.layouts.simple.master')
@section('title', 'User Profile')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/photoswipe.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Doctor Profile') }}</h3>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">
                <!-- user profile first-style start-->
                <div class="col-sm-12">
                    <div class="card hovercard text-center">

                        <div class="info">
                            <div class="row">
                                <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-envelope"></i>{{ trans('lang.Email') }}</h6>
                                                <span>{{$doctor->email}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-calendar"></i> {{ trans('lang.Birth Day') }}</h6>
                                                <span>{{$doctor->birth_date}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                    <div class="user-designation">
                                        <div class="title"><a target="_blank" href="">{{$doctor->first_name}} {{$doctor->last_name}}</a></div>
                                        <div class="desc mt-2">Doctor</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-phone"></i> {{ trans('lang.Contact') }} </h6>
                                                <span>{{$doctor->phone}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-location-arrow"></i>{{ trans('lang.WorkPlace') }}</h6>
                                                <span>{{$doctor->location}}</span>
                                                <br>
                                                <span>{{$doctor->workplace}}</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="">
                                @csrf
                                <a id="mapchange"  data-token="{{ csrf_token() }}" data-id="{{$doctor->user_id}}"  class="btn btn-danger-gradien">{{ trans('lang.Set Location') }}</a>
                                <a class="btn btn-primary" href="/manager-panel/doctor/deposit/{{$doctor->user_id}}">{{ trans('lang.Deposit') }}</a>
                                <a class="btn btn-primary" href="/manager-panel/doctor/orders/{{$doctor->user_id}}">{{ trans('lang.Orders') }}</a>

                                <a class="btn btn-success" href="{{$maplink}}">{{ trans('lang.Location') }}</a>
{{--                                <a class="btn btn-primary" href="http://www.google.com/maps/place/<?php echo $doctor->doctor_map_x; ?>">Location</a>--}}
                            </div>

                        </div>
                    </div>
                </div>
                <h3>{{ trans('lang.Payments') }}</h3>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="dt-ext table-responsive">
                                <table class="display" id="export-button">

                                    <thead>
                                    <tr>
                                        <th>{{ trans('lang.iD') }}</th>
                                        <th>{{ trans('lang.Amount') }}</th>
                                        <th>{{ trans('lang.Doctor Paid') }}</th>
                                        @if (\Illuminate\Support\Facades\Auth::user()->role_id == 1 or \Illuminate\Support\Facades\Auth::user()->role_id == 2)
                                            <th>{{ trans('lang.Manager Paid') }}</th>

                                        @endif
                                        <th>{{ trans('lang.Manager') }}</th>
                                        <th>{{ trans('lang.Date') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td><a href="/manager-panel/orders/detail/{{$payment->orderid}}">{{$payment->od_id}}</a></td>
                                            <td>{{$payment->amount}} </td>
                                            <td>{{$payment->doctor_paid}} </td>
                                            @if (\Illuminate\Support\Facades\Auth::user()->role_id == 1 or \Illuminate\Support\Facades\Auth::user()->role_id == 2)
                                                <td>{{$payment->manager_paid}} </td>
                                            @endif

                                            <td><a href="/manager-panel/profile">{{ $payment->manager_first_name }} {{ $payment->manager_last_name }}</a></td>
                                            <td>{{$payment->doctor_paid_created}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{ trans('lang.iD') }}</th>
                                        <th>{{ trans('lang.Amount') }}</th>
                                        <th>{{ trans('lang.Doctor Paid') }}</th>
                                        <th>{{ trans('lang.Manager Paid') }}</th>
                                        <th>{{ trans('lang.Manager') }}</th>
                                        <th>{{ trans('lang.Date') }}</th>

                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div></div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
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
