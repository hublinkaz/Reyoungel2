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
									<th>{{ trans('lang.Product Name') }}</th>
									<th>{{ trans('lang.Price') }}</th>
									<th>{{ trans('lang.All Products') }}</th>
									<th>{{ trans('lang.Price') }}</th>
									<th>{{ trans('lang.Warehouse') }}</th>
									<th>{{ trans('lang.Price') }}</th>
                                    <th>{{ trans('lang.Doctor') }}</th>
                                    <th>{{ trans('lang.Price') }}</th>
									<th>{{ trans('lang.Manager') }}</th>
									<th>{{ trans('lang.Price') }}</th>

								</tr>
							</thead>
							<tbody>
@php
    $count=1;
@endphp
                            @foreach ($products as $product)
                                 <tr>

                                        <td>{{$count++}} </td>
                                        <td>{{$product->name_az}}</td>
                                        <td>{{$product->price}} Azn</td>
                                        <td>{{$product->qty}}</td>
                                        <td>{{$product->total_price}} Azn</td>
                                        <td>{{$product->admin_qty}}</td>
                                        <td>{{$product->admin_price}} Azn</td>
                                        <td>{{$product->doctor_qty}}</td>
                                        <td>{{$product->doctor_price}} Azn</td>
                                        <td>{{$product->manager_qty}}</td>
                                        <td>{{$product->manager_price}} Azn</td>
                                    </tr>

                            @endforeach
                            <td> </td>
                            <td>                                   {{ trans('lang.Total') }}
</td>
                            <td></td>
                            <td>{{$total[0]->qty}}</td>
                            <td>{{$total[0]->total_price}} Azn</td>
                            <td>{{$total[0]->admin_qty}}</td>
                            <td>{{$total[0]->admin_price}} Azn</td>
                            <td>{{$total[0]->doctor_qty}}</td>
                            <td>{{$total[0]->doctor_price}} Azn</td>
                            <td>{{$total[0]->manager_qty}}</td>
                            <td>{{$total[0]->manager_price}} Azn</td>
							</tbody>
							<tfoot>
								<tr>
                                    <th>{{ trans('lang.No') }}</th>
                                    <th>{{ trans('lang.Product Name') }}</th>
                                    <th>{{ trans('lang.Price') }}</th>
                                    <th>{{ trans('lang.All Products') }}</th>
                                    <th>{{ trans('lang.Price') }}</th>
                                    <th>{{ trans('lang.Warehouse') }}</th>
                                    <th>{{ trans('lang.Price') }}</th>
                                    <th>{{ trans('lang.Doctor') }}</th>
                                    <th>{{ trans('lang.Price') }}</th>
                                    <th>{{ trans('lang.Manager') }}</th>
                                    <th>{{ trans('lang.Price') }}</th>

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
