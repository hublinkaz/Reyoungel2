@extends('admin.layouts.simple.master')
@section('title', 'HTML 5 Data Export')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')

<h3>{{ trans('lang.general report extract') }}</h3>
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
									<th>{{ trans('lang.Id') }}</th>
									<th>{{ trans('lang.Name') }}</th>
									<th>{{ trans('lang.Total buy count') }}</th>
									<th>{{ trans('lang.Total buy price') }}</th>
									<th>{{ trans('lang.TOPLAM GÖTÜRÜLƏN MAL QUTU') }}</th>
									<th>{{ trans('lang.TOPLAM GÖTÜRÜLƏN MAL MANATLA') }}</th>
									<th>{{ trans('lang.ŞİRKƏTƏ TOPLAM ÖDƏNİŞ') }}</th>
									<th>{{ trans('lang.TOPLAM ALINAN FAİZLƏR') }}</th>

								</tr>
							</thead>
							<tbody>
                            @php
                                $total_qty =0;
                                $total_amount =0;
                                $total_total_qty =0;
                                $total_total_amount =0;
                                $total_company_price =0;
                                $total_manager_price =0;
                            @endphp

                            @foreach ($managers as $manager)

                                @php
                                $total_qty +=$manager->qty;
                                $total_amount += round($manager->amount,1);
                                $total_total_qty +=$manager->total_qty;
                                $total_total_amount +=round($manager->total_amount,1);
                                $total_company_price +=round($manager->company_price,1);
                                $total_manager_price+=round($manager->manager_price,1);
                                @endphp

                                    <tr>

                                        <td>{{$manager->id}} </td>
                                        <td>{{ $manager->first_name}} {{$manager->last_name}}</td>
                                        <td>{{$manager->qty}}</td>
                                        <td>{{round($manager->amount,1)}}</td>
                                        <td>{{$manager->total_qty}}</td>
                                        <td>{{round($manager->total_amount,1)}}</td>
                                        <td>{{ round($manager->company_price,1)}}</td>
                                        <td>{{round($manager->manager_price,1)}}</td>


                                    </tr>

                            @endforeach

                            <tr>

                                <td> </td>
                                <td>{{ trans('lang.Total') }}</td>
                                <td>{{$total_qty}}</td>
                                <td>{{$total_amount}}</td>
                                <td>{{$total_total_qty}}</td>
                                <td>{{$total_total_amount}}</td>
                                <td>{{$total_company_price}}</td>
                                <td>{{$total_manager_price}}</td>


                            </tr>

							</tbody>
							<tfoot>
								<tr>
                                    <th>{{ trans('lang.Id') }}</th>
                                    <th>{{ trans('lang.Name') }}</th>
                                    <th>{{ trans('lang.Total buy count') }}</th>
                                    <th>{{ trans('lang.Total buy price') }}</th>
                                    <th>{{ trans('lang.TOPLAM GÖTÜRÜLƏN MAL QUTU') }}</th>
                                    <th>{{ trans('lang.TOPLAM GÖTÜRÜLƏN MAL MANATLA') }}</th>
                                    <th>{{ trans('lang.ŞİRKƏTƏ TOPLAM ÖDƏNİŞ') }}</th>
                                    <th>{{ trans('lang.TOPLAM ALINAN FAİZLƏR') }}</th>

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
