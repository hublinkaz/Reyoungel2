@extends('admin.layouts.simple.master')
@section('title', 'HTML 5 Data Export')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')

<h3>{{ trans('lang.Doctors') }}</h3>
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
									<th>{{ trans('lang.No') }}</th>
									<th>{{ trans('lang.Doctor Name') }}</th>
									<th>{{ trans('lang.Manager Name') }}</th>
									<th>{{ trans('lang.Phone') }}</th>
									<th>{{ trans('lang.Email') }}</th>
									<th>{{ trans('lang.Work Address') }}</th>
									<th>{{ trans('lang.Workplace') }}</th>
									<th>{{ trans('lang.Card identity') }}</th>
									<th>{{ trans('lang.Birth Day') }}</th>

								</tr>
							</thead>
							<tbody>
@php
    $count=1;
@endphp
                            @foreach ($doctors as $doctor)
                                 <tr>

                                        <td>{{$count++}} </td>
                                        <td>{{$doctor->first_name}} {{$doctor->last_name}} </td>
                                        <td>{{$doctor->manager_first_name}} {{$doctor->manager_last_name}} </td>
                                        <td>{{ $doctor->phone }}</td>
                                        <td>{{$doctor->email}}</td>
                                     <td>{{$doctor->workplace}}</td>
                                     <td>{{$doctor->location}}</td>
                                        <td>{{$doctor->card_number}}</td>
                                        <td>{{$doctor->birth_date}}</td>



                                    </tr>

                            @endforeach

							</tbody>
							<tfoot>
								<tr>
                                    <th>{{ trans('lang.No') }}</th>
                                    <th>{{ trans('lang.Doctor Name') }}</th>
                                    <th>{{ trans('lang.Manager Name') }}</th>
                                    <th>{{ trans('lang.Phone') }}</th>
                                    <th>{{ trans('lang.Email') }}</th>
                                    <th>{{ trans('lang.Workplace') }}</th>
                                    <th>{{ trans('lang.Location') }}</th>
                                    <th>{{ trans('lang.Card identity') }}</th>
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
