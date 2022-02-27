@extends('manager.layouts.simple.master')
@section('title', 'HTML 5 Data Export')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')

<h3>Ödənişlər</h3>

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
									<th>{{ trans('lang.Order id') }}</th>
                                    <th>{{ trans('lang.Amount') }}</th>
                                    <th>{{ trans('lang.Doctor') }}</th>
                                    <th>{{ trans('lang.Doctor Paid') }}</th>
                                    <th>{{ trans('lang.Manager') }}</th>
									<th>{{ trans('lang.Manager Paid') }}</th>
									<th>{{ trans('lang.Date) }}</th>

								</tr>
							</thead>
							<tbody>

                            @foreach ($payments as $payment)



                                    <tr >
                                        <td><a href="orders/detail/{{$payment->order_id}}">{{ $payment->od_id}}</a></td>
                                        <td>{{ $payment->amount}}</td>
                                        <td>{{ $payment->doctor_first_name }} {{ $payment->doctor_last_name }}</td>
                                        @if($payment->doctor_paid != $payment->amount)
                                        <td style="background-color:#FF0000;color: #ffffff">{{ $payment->doctor_paid}}</td>
                                        @else
                                        <td>{{ $payment->doctor_paid}}</td>
                                        @endif
                                        <td>{{ $payment->manager_first_name}} {{ $payment->manager_last_name}}</td>

                                        @if($payment->manager_paid !== $payment->doctor_paid)
                                        <td style="background-color:#FF0000;color: #ffffff">{{ $payment->manager_paid }}</td>
                                        @else
                                        <td >{{ $payment->manager_paid }}</td>
                                        @endif
                                        <td>{{ $payment->doctors_payments_created_at}}</td>

                                    </tr>


                            @endforeach

							</tbody>
							<tfoot>
								<tr>
                                    <th>{{ trans('lang.Order id') }}</th>
                                    <th>{{ trans('lang.Amount') }}</th>
                                    <th>{{ trans('lang.Doctor') }}</th>
                                    <th>{{ trans('lang.Doctor Paid') }}</th>
                                    <th>{{ trans('lang.Manager') }}</th>
                                    <th>{{ trans('lang.Manager Paid') }}</th>
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
