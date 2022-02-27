@php

    $notif=\App\Models\Orders::where('is_delivered',0)->groupBy('is_delivered')->count();
$payment=\Illuminate\Support\Facades\DB::select("select count(*) as count from  (select doctors_payments.created_at as date,users.first_name as first_name,users.last_name as last_name ,
                       SUM(doctors_payments.paid) as doctor_paid,man_payment.manager_paid ,orders.manager_id as manager_id,
                       managers.percentage_value as percent_value,order_details.order_id
                from doctors_payments
                         join order_details on doctors_payments.order_detail_id = order_details.id
                         join orders on orders.id = order_details.order_id
                         join users on orders.manager_id = users.id
                         join managers on managers.user_id = orders.manager_id
                         left join (select manager_payments.created_at as
                                          date,users.first_name as first_name
                                         ,users.last_name as last_name
                                         ,SUM(manager_payments.paid) as manager_paid
                                         ,orders.manager_id as manager_id,
                                        managers.percentage_value as percent,order_id
                                    from manager_payments
                                             join order_details on manager_payments.order_detail_id = order_details.id
                                             join orders on orders.id = order_details.order_id
                                             join users on orders.manager_id = users.id
                                             join managers on managers.user_id = orders.manager_id GROUP BY order_id
                ) as man_payment on  man_payment.order_id = order_details.order_id
                GROUP BY order_id
               ) as payments where doctor_paid != manager_paid or manager_paid is null");
@endphp

<div class="sidebar-wrapper">

	<div>
		<div class="logo-wrapper">
			<a href="{{route('admin.dashboard')}}"><img class="img-fluid for-light" style="width: 70%;" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" style="width: 70%;" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>

		<div class="logo-icon-wrapper"><a href="{{route('admin.dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{route('admin.dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>

					<li class="sidebar-list">
						<label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='admin.dashboard' ? 'active' : '' }}" href="{{route('admin.dashboard')}}"><i data-feather="home"></i><span class="lan-3">{{ trans('lang.Dashboards') }}</span>
                        </a>
					</li>
                    <li class="sidebar-list">
                        <label class="badge badge-success">{{\App\Models\OrderDetails::where('is_return',1)->count()==0 ? null : \App\Models\OrderDetails::where('is_return',1)->count() }}</label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='returns' ? 'active' : '' }}" href="{{route('returns')}}"><i data-feather="corner-left-up"></i><span class="lan-3">{{ trans('lang.Doctor Returns') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <label class="badge badge-success">{{\App\Models\ReturunProductQuery::all()->count()==0 ? null : \App\Models\ReturunProductQuery::all()->count() }}</label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='manager.return.product' ? 'active' : '' }}" href="{{route('manager.return.product')}}"><i data-feather="corner-left-up"></i><span class="lan-3">{{ trans('lang.Manager Returns') }}</span>
                        </a>
                    </li>



                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == 'panel/report/doctor' ? 'active' : '' }}" href="#"><i data-feather="book-open"></i><span class="lan-3">{{ trans('lang.Report') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/staffes' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='report.doctor' ? 'active' : '' }}" href="{{route('report.doctor')}}">{{ trans('lang.Doctor in Report') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='report.product' ? 'active' : '' }}" href="{{route('report.product')}}">{{ trans('lang.Product in Report') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='report.manager' ? 'active' : '' }}" href="{{route('report.manager')}}">{{ trans('lang.general report extract') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='report.deposit' ? 'active' : '' }}" href="{{route('report.deposit')}}">{{ trans('lang.Manager Deposit') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='report.doctors' ? 'active' : '' }}" href="{{route('report.doctors')}}">{{ trans('lang.Doctors') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='report.warehouse' ? 'active' : '' }}" href="{{route('report.warehouse')}}">{{ trans('lang.Warehouse') }}</a></li>
                        </ul>
                    </li>



                    {{-- Dashboard - End--}}
                    {{-- Products - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{Route::currentRouteName()=='products' ? 'active' : ''}}" href="#"><i data-feather="box"></i><span class="lan-3">{{ trans('lang.Products') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->is('panel/products') ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='products' ? 'active' : '' }}" href="{{route('products')}}">{{ trans('lang.Product List') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='product.create' ? 'active' : '' }}" href="{{route('product.create')}}">{{ trans('lang.Add Product') }}</a></li>
                        </ul>
                    </li>
                    {{-- Products - End--}}




                    {{-- Gift - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success">{{\App\Models\GiftQuery::all()->count()==0 ?  null : \App\Models\GiftQuery::all()->count() }}</label><a class="sidebar-link sidebar-title {{Route::currentRouteName()=='gifts' ? 'active' : ''}}" href="#"><i data-feather="gift"></i><span class="lan-3">{{ trans('lang.Gifts') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->is('panel/products') ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                            <li> <label  style="    margin-top: -6px;" class="badge badge-success">{{\App\Models\GiftQuery::all()->count()==0 ? null : \App\Models\GiftQuery::all()->count() }}</label><a class="lan-5 {{ Route::currentRouteName()=='gift.query' ? 'active' : '' }}" href="{{route('gift.query')}}">{{ trans('lang.Query a gift') }}</a></li>
                            <li><a class="lan-4 {{ Route::currentRouteName()=='gifts' ? 'active' : '' }}" href="{{route('gifts')}}">{{ trans('lang.Gifts') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='gift.create' ? 'active' : '' }}" href="{{route('gift.create')}}">{{ trans('lang.Make a gift') }}</a></li>
                        </ul>
                    </li>

                    {{-- Gift - End--}}


                    {{-- Sale - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success">{{\App\Models\Orders::where('is_delivered',0)->count()==0 ? null : \App\Models\Orders::where('is_delivered',0)->count() }}</label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/orders' ? 'active' : '' }}" href="#"><i data-feather="shopping-bag"></i><span class="lan-3">{{ trans('lang.Order') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'orders' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/orders' ? 'block;' : 'none;' }}">
                            <li> <label  style="margin-top: -6px;" class="badge badge-success">{{\App\Models\Orders::where('is_delivered',0)->count()==0 ? null : \App\Models\Orders::where('is_delivered',0)->count() }}</label><a class="lan-4 {{ Route::currentRouteName()=='orders' ? 'active' : '' }}" href="{{route('orders')}}">{{ trans('lang.Sale List') }}</a></li>
                        </ul>
                    </li>

                    {{-- Sale - End--}}

                    {{-- Doctor - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success">{{\App\Models\User::where('role_id',5)->where('is_active',0)->count()==0 ? null : \App\Models\User::where('role_id',5)->where('is_active',0)->count() }}</label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/admin/doctors' ? 'active' : '' }}" href="#"><i data-feather="plus-circle"></i><span class="lan-3">{{ trans('lang.Doctors') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'doctors.index' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/doctors' ? 'block;' : 'none;' }}">
                            <li><label  style="margin-top: -6px;" class="badge badge-success">{{\App\Models\User::where('role_id',5)->where('is_active',0)->count()==0 ? null : \App\Models\User::where('role_id',5)->where('is_active',0)->count() }}</label><a class="lan-4 {{ Route::currentRouteName()=='doctors' ? 'active' : '' }}" href="{{route('doctors')}}">{{ trans('lang.Doctor List') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='doctor.create' ? 'active' : '' }}" href="{{route('doctor.create')}}">{{ trans('lang.Add Doctor') }}</a></li>
                        </ul>
                    </li>

                    {{-- Doctor - End--}}
                    {{-- Managers - Start--}}


                            <li class="sidebar-list">
                                    <label class="badge badge-success">{{\App\Models\WarehouseQuery::count()==0 ? null : \App\Models\WarehouseQuery::count() }}</label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/admin/doctors' ? 'active' : '' }}" href="#"><i data-feather="briefcase"></i><span class="lan-3">{{ trans('lang.Managers') }}</span>
                                        <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'doctors.index' ? 'down' : 'right' }}"></i></div>
                                    </a>
                                    <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/managers' ? 'block;' : 'none;' }}">
                                        <li><label  style="margin-top: -6px;" class="badge badge-success">{{\App\Models\WarehouseQuery::count()==0 ? null : \App\Models\WarehouseQuery::count() }}</label><a class="lan-5 {{ Route::currentRouteName()=='manager.query' ? 'active' : '' }}" href="{{route('manager.query')}}">{{ trans('lang.Manager Query') }}</a></li>
                                        <li><a class="lan-4 {{ Route::currentRouteName()=='managers' ? 'active' : '' }}" href="{{route('managers')}}">{{ trans('lang.Manager List') }}</a></li>
                                        <li><a class="lan-5 {{ Route::currentRouteName()=='manager.create' ? 'active' : '' }}" href="{{route('manager.create')}}">{{ trans('lang.Add Manager') }}</a></li>
                                    </ul>
                                </li>

                    {{-- Managers - End--}}
                        {{-- Deliverers - Start--}}
                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/admin/drivers' ? 'active' : '' }}" href="#"><i data-feather="map"></i><span class="lan-3">{{ trans('lang.Drivers') }}</span>
                                <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right' }}"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/managers' ? 'block;' : 'none;' }}">
                                <li><a class="lan-4 {{ Route::currentRouteName()=='drivers' ? 'active' : '' }}" href="{{route('drivers')}}">{{ trans('lang.Driver List') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='driver.create' ? 'active' : '' }}" href="{{route('driver.create')}}">{{ trans('lang.Add Driver') }}</a></li>
                            </ul>
                        </li>

                        {{-- Deliverers - End--}}
                        {{-- Staff - Start--}}

                            <li class="sidebar-list">
                                    <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/admin/drivers' ? 'active' : '' }}" href="#"><i data-feather="users"></i><span class="lan-3">{{ trans('lang.Staff') }}</span>
                                        <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right' }}"></i></div>
                                    </a>
                                    <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/staffes' ? 'block;' : 'none;' }}">
                                        <li><a class="lan-4 {{ Route::currentRouteName()=='staffes' ? 'active' : '' }}" href="{{route('staffes')}}">{{ trans('lang.Staff List') }}</a></li>
                                        <li><a class="lan-5 {{ Route::currentRouteName()=='staff.create' ? 'active' : '' }}" href="{{route('staff.create')}}">{{ trans('lang.Add Staff') }}</a></li>
                                    </ul>
                                </li>

                        {{-- Staff - End--}}
                        {{-- Invoices - Start--}}



                            <li class="sidebar-list">
                                <label class="badge badge-success">{{$payment[0]->count==0 ? null : $payment[0]->count }}</label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == 'panel/payments' ? 'active' : '' }}" href="#"><i data-feather="book-open"></i><span class="lan-3">{{ trans('lang.Invoices') }}</span>
                                    <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right' }}"></i></div>
                                </a>
                                <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/staffes' ? 'block;' : 'none;' }}">
                                    <li><label  style="margin-top: -6px;" class="badge badge-success">{{$payment[0]->count==0 ? null : $payment[0]->count }}</label><a class="lan-4 {{ Route::currentRouteName()=='payments' ? 'active' : '' }}" href="{{route('payments')}}">{{ trans('lang.Invoices') }}</a></li>
{{--                                    <li><a class="lan-5 {{ Route::currentRouteName()=='payment.create' ? 'active' : '' }}" href="{{route('payment.create')}}">{{ trans('lang.Add Payment') }}</a></li>--}}
                                    <li><a class="lan-5 {{ Route::currentRouteName()=='payment.percent' ? 'active' : '' }}" href="{{route('payment.percent')}}">{{ trans('lang.Manager Paid') }}</a></li>
                                </ul>
                            </li>
                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/slides' ? 'active' : '' }}" href="#"><i data-feather="box"></i><span class="lan-3">{{ trans('lang.Slides') }}</span>
                                <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/slides' ? 'down' : 'right' }}"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                                <li><a class="lan-4 {{ Route::currentRouteName()=='slides' ? 'active' : '' }}" href="{{route('slides')}}">{{ trans('lang.Slide List') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='slide.create' ? 'active' : '' }}" href="{{route('slide.create')}}">{{ trans('lang.Add Slide') }}</a></li>
                            </ul>
                        </li>





                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/blogs' ? 'active' : '' }}" href="#"><i data-feather="box"></i><span class="lan-3">{{ trans('lang.Blog') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/slides' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='blogs' ? 'active' : '' }}" href="{{route('blogs')}}">{{ trans('lang.Blogs List') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='blog.create' ? 'active' : '' }}" href="{{route('blog.create')}}">{{ trans('lang.Add Blogs') }}</a></li>
                        </ul>
                    </li>
                        {{-- Settings - Start--}}

                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/settings/doctor' ? 'active' : '' }}" href="#"><i data-feather="settings"></i><span class="lan-3">{{ trans('lang.Settings') }}</span>
                                <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/settings/doctor' ? 'down' : 'right' }}"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                                <li><a class="lan-4 {{ Route::currentRouteName()=='front.doctors' ? 'active' : '' }}" href="{{route('front.doctors')}}">{{ trans('lang.Doctors') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='front.doctors.create' ? 'active' : '' }}" href="{{route('front.doctors.create')}}">{{ trans('lang.Add Doctor') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='banners' ? 'active' : '' }}" href="{{route('banners')}}">{{ trans('lang.Banners') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='settings' ? 'active' : '' }}" href="{{route('settings')}}">{{ trans('lang.Panel Settings') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='setting.create' ? 'active' : '' }}" href="{{route('setting.create')}}">{{ trans('lang.Add Panel Settings') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='pages' ? 'active' : '' }}" href="{{route('pages')}}">{{ trans('lang.Pages') }}</a></li>
{{--                                <li><a class="lan-5 {{ Route::currentRouteName()=='page.create' ? 'active' : '' }}" href="{{route('page.create')}}">{{ trans('lang.About Page') }}</a></li>--}}
                            </ul>
                        </li>



                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/warehouse' ? 'active' : '' }}" href="#"><i data-feather="archive"></i><span class="lan-3">{{ trans('lang.All Products') }}</span>
                                <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/warehouse' ? 'down' : 'right' }}"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                                <li><a class="lan-4 {{ Route::currentRouteName()=='warehouse' ? 'active' : '' }}" href="{{route('warehouse')}}">{{ trans('lang.All Warehouse') }}</a></li>
                                <!--<li><a class="lan-5 {{ Route::currentRouteName()=='warehouse.doctors' ? 'active' : '' }}" href="{{route('warehouse.doctors')}}">{{ trans('lang.Doctors Deposit') }}</a></li>-->
                                <li><a class="lan-5 {{ Route::currentRouteName()=='warehouse.managers' ? 'active' : '' }}" href="{{route('warehouse.managers')}}">{{ trans('lang.Manager Deposit') }}</a></li>
                            </ul>
                        </li>


                <br>
                <br>
                <br>

                    {{-- Settings - End--}}
			</ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>
