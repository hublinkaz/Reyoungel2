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
									<th>{{ trans('lang.Id') }}</th>
									<th>{{ trans('lang.Name') }}</th>
{{--									<th>{{ trans('lang.Units') }}</th>--}}
									<th>{{ trans('lang.Qty') }}</th>
									<th>{{ trans('lang.Price') }}</th>
									<th>{{ trans('lang.Total') }}</th>
									<th>{{ trans('lang.Half Paid') }}</th>
									<th>{{ trans('lang.Will be paid') }}</th>

								</tr>
							</thead>
							<tbody>
                            @php
                                $total_qty =0;
                                $total_price =0;
                                $total_total_price=0;
                                $total_paid=0;
                            @endphp
                            @foreach ($products as $product)

                                @php
                                $total_qty +=$product->qty;
                                $total_price +=round($product->price,1);
                                $total_total_price += $product->total_price;
                                $total_paid += $product->paid;
                                @endphp
                                    <tr>

                                        <td>{{$product->id}} </td>
                                        <td>{{ $product->name_az }}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>{{round($product->price,1)}}</td>
                                        <td>{{$product->total_price}}</td>
                                        <td>{{round($product->paid,1)}}</td>
                                        <td>{{$product->total_price - round($product->paid,1)}}</td>


                                    </tr>

                            @endforeach
                            <tr>

                                <td></td>
                                <td>Toplam :</td>
                                <td>{{ $total_qty }}</td>
                                <td>{{$total_price}}</td>
                                <td>{{$total_total_price}}</td>
                                <td>{{ $total_paid}}</td>
                                <td>{{$total_total_price-$total_paid}}</td>


                            </tr>
							</tbody>
							<tfoot>
								<tr>
                                    <th>{{ trans('lang.Id') }}</th>
                                    <th>{{ trans('lang.Name') }}</th>
{{--                                    <th>{{ trans('lang.Units') }}</th>--}}
                                    <th>{{ trans('lang.Qty') }}</th>
                                    <th>{{ trans('lang.Price') }}</th>
                                    <th>{{ trans('lang.Total') }}</th>
                                    <th>{{ trans('lang.Paid') }}</th>
                                    <th>{{ trans('lang.Will be paid') }}</th>


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
