@extends('staff.layouts.simple.master')
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
                                    <th>{{ trans('lang.Date') }}</th>
                                    <th>{{ trans('lang.Manager') }}</th>
                                    <th>{{ trans('lang.Amount') }}</th>
                                    <th>{{ trans('lang.Doctor Paid') }}</th>
                                    <th>{{ trans('lang.Manager Paid') }}</th>
									<th>Admin Təstiqi</th>

								</tr>
							</thead>
							<tbody>

                            @foreach ($doctors as $doctor)
                                @if($doctor->doctor_paid != $doctor->manager_paid)
                                    <tr >
                                     <td><a href="orders/detail/{{$doctor->order_id}}">{{ $doctor->order_id}}</a></td>
                                     <td>{{ $doctor->date}}</td>
                                     <td>{{ $doctor->first_name }} {{ $doctor->last_name }}</td>
                                     <td>{{ $doctor->amount}} Azn</td>
                                     <td>{{ $doctor->doctor_paid}} Azn</td>
                                     <td>{{ $doctor->manager_paid}} Azn</td>
                                         {{--                                         <td>{{ $doctor->manager_paid}}</td>--}}


                                        <td style="background-color:#FF0000;color: #ffffff">
                                            <form action="{{ route('payment.status',$doctor->order_id) }}" method="POST">
                                            @csrf
                                                <input  class="form-control" type="text"  name="manager_paid" id="manager_paid" value="{{ $doctor->doctor_paid-$doctor->manager_paid }}" >
                                                <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs">Təstiqlə</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endif

                            @endforeach

							</tbody>
							<tfoot>
								<tr>
                                    <th>{{ trans('lang.Order id') }}</th>
                                    <th>{{ trans('lang.Date') }}</th>
                                    <th>{{ trans('lang.Manager') }}</th>
                                    <th>{{ trans('lang.Amount') }}</th>
                                    <th>{{ trans('lang.Doctor Paid') }}</th>
                                    <th>{{ trans('lang.Manager Paid') }}</th>
                                    <th>Admin Təstiqi</th>


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
