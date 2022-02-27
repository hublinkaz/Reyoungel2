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
									<th>{{ trans('lang.Name') }}</th>
									<th>{{ trans('lang.Phone') }}</th>
									<th>{{ trans('lang.Workplace') }}</th>
									<th>{{ trans('lang.Location') }}</th>
									<th>{{ trans('lang.Product Name') }}</th>
									<th>{{ trans('lang.Units') }}</th>
									<th>{{ trans('lang.Price') }}</th>
									<th>{{ trans('lang.Deposit Date') }}</th>
									<th>{{ trans('lang.Paid Date') }}</th>
									<th>{{ trans('lang.Paid') }}</th>
								</tr>
							</thead>
							<tbody>

                            @foreach ($payments as $payment)

                                @if($payment->price ==0 AND $payment->paid == 0)
                                    <tr>

                                        <td>{{$count++}} </td>
                                        <td>{{$payment->first_name}} {{$payment->last_name}} </td>
                                        <td>{{ $payment->phone }}</td>
                                        <td>{{$payment->workplace}}</td>
                                        <td>{{$payment->location}}</td>
                                        <td>{{$payment->product_name}}</td>
                                        <td>{{$payment->units}}</td>
                                        <td>{{ trans('lang.Gift') }}</td>
                                        <td>{{$payment->created}}</td>
                                        <td>{{ trans('lang.Gift') }}</td>
                                        <td>{{ trans('lang.Gift') }}</td>


                                    </tr>
                                    @else

                                    <tr>
                                        <td>{{$count++}} </td>
                                        <td>{{$payment->first_name}} {{$payment->last_name}} </td>
                                        <td>{{ $payment->phone }}</td>
                                        <td>{{$payment->workplace}}</td>
                                        <td>{{$payment->location}}</td>
                                        <td>{{$payment->product_name}}</td>
                                        <td>{{$payment->units}}</td>
                                        <td>{{ round($payment->price,1)}}</td>
                                        <td>{{$payment->created}}</td>
                                        <td>{{$payment->paid_created}}</td>
                                        <td>{{round($payment->paid,1)}}</td>

                                    </tr>
                                    @endif

                            @endforeach
                            <tr>

                                <td></td>
                                <td>{{ trans('lang.Total Product Number')}} :</td>
                                <td>{{$totalcount}}</td>
                                <td>{{ trans('lang.Total Amound')}} :</td>
                                <td>{{round($amount,1)}} Azn</td>
                                <td>{{ trans('lang.Total Payment Amount')}} :</td>
                                <td>{{round($paid,1) }} Azn</td>
                                <td>{{ trans('lang.Total Balance Debt')}} :</td>
                                <td>{{round($amount,1)-round($paid,1) }} Azn</td>
                                <td></td>
                                <td></td>

                            </tr>
							</tbody>
							<tfoot>
								<tr>
                                    <th>{{ trans('lang.No') }}</th>
                                    <th>{{ trans('lang.Name') }}</th>
                                    <th>{{ trans('lang.Phone') }}</th>
                                    <th>{{ trans('lang.Workplace') }}</th>
                                    <th>{{ trans('lang.Location') }}</th>
                                    <th>{{ trans('lang.Product Name') }}</th>
                                    <th>{{ trans('lang.Units') }}</th>
                                    <th>{{ trans('lang.Price') }}</th>
                                    <th>{{ trans('lang.Deposit Date') }}</th>
                                    <th>{{ trans('lang.Paid Date') }}</th>
                                    <th>{{ trans('lang.Paid') }}</th>

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
