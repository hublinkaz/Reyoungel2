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
									<th>{{ trans('lang.Total take count') }}</th>
									<th>{{ trans('lang.Total take price') }}</th>
									<th>{{ trans('lang.ŞİRKƏTƏ TOPLAM ÖDƏNİŞ') }}</th>
									<th>{{ trans('lang.TOPLAM ALINAN FAİZLƏR') }}</th>
									<th>{{ trans('lang.Date') }}</th>

								</tr>
							</thead>
							<tbody>

                            @foreach ($products as $product)

                                    <tr>

                                        <td>{{$product->id}} </td>
                                        <td>{{ $product->name_az }}</td>
                                        <td>{{$product->order_qty}}</td>
                                        <td>{{round($product->order_price,1)}}</td>
                                        <td>{{$product->total_order_qty}}</td>
                                        <td>{{round($product->total_amount,1)}}</td>
                                        <td>{{ round($product->company_price,1)}}</td>
                                        <td>{{round($product->manager_price,1)}}</td>
                                        <td>{{$product->created}}</td>


                                    </tr>

                            @endforeach
                            <tr>

                                <td></td>
                                <td>Toplam :</td>
                                <td>{{$total_paid[0]->qty}}</td>
                                <td>{{round($total_paid[0]->paid,1)}} Azn</td>
                                <td>{{$total_paid[0]->qty + $total_nopaid[0]->qty }}</td>
                                <td>{{round($total_paid[0]->amount + $total_nopaid[0]->amount,1)}}  Azn</td>
                                <td>{{ round($total_paid[0]->paid-($total_paid[0]->paid*$total_paid[0]->percentage_value)/100,1)}}  Azn</td>
                                <td>{{ round(($total_paid[0]->paid*$total_paid[0]->percentage_value)/100,1)}}  Azn</td>
                                <td></td>


                            </tr>
							</tbody>
							<tfoot>
								<tr>
                                    <th>{{ trans('lang.Id') }}</th>
                                    <th>{{ trans('lang.Name') }}</th>
                                    <th>{{ trans('lang.Total buy count') }}</th>
                                    <th>{{ trans('lang.Total buy price') }}</th>
                                    <th>{{ trans('lang.Total take count') }}</th>
                                    <th>{{ trans('lang.Total take price') }}</th>
                                    <th>{{ trans('lang.ŞİRKƏTƏ TOPLAM ÖDƏNİŞ') }}</th>
                                    <th>{{ trans('lang.TOPLAM ALINAN FAİZLƏR') }}</th>
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
