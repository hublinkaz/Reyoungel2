@php

    $notif=\App\Models\Orders::where('is_delivered',0)->groupBy('is_delivered')->count();
@endphp
<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{route('manager.dashboard')}}"><img class="img-fluid for-light" style="width: 70%;" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" style="width: 70%;" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('manager.dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{route('manager.dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
{{--					<li class="sidebar-main-title">--}}
{{--						<div>--}}
{{--							<h6 class="lan-1">{{ request()->is('panel/products') }} </h6>--}}
{{--                     		<p class="lan-2">{{ trans('lang.admin-menu-desc.') }}</p>--}}
{{--						</div>--}}
{{--					</li>--}}
{{--                     Dashboard - Start--}}
					<li class="sidebar-list">
						<label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='manager.dashboard' ? 'active' : '' }}" href="{{route('manager.dashboard')}}"><i data-feather="home"></i><span class="lan-3">{{ trans('lang.Dashboards') }}</span>
                        </a>
					</li>
                    {{-- Dashboard - End--}}



                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='manager.manager.warehouse' ? 'active' : '' }}" href="{{route('manager.manager.warehouse')}}"><i data-feather="box"></i><span class="lan-3">{{ trans('lang.Warehouse') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='manager.manager.all_deposits' ? 'active' : '' }}" href="{{route('manager.manager.all_deposits')}}"><i data-feather="box"></i><span class="lan-3">{{ trans('lang.All Warehouse') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='manager.manager.deposit' ? 'active' : '' }}" href="{{route('manager.manager.deposit')}}"><i data-feather="truck"></i><span class="lan-3">{{ trans('lang.Deposit') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == 'panel/report/doctor' ? 'active' : '' }}" href="#"><i data-feather="book-open"></i><span class="lan-3">{{ trans('lang.Report') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/staffes' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='manager.report.doctor' ? 'active' : '' }}" href="{{route('manager.report.doctor')}}">{{ trans('lang.Doctor in Report') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='manager.report.product' ? 'active' : '' }}" href="{{route('manager.report.product')}}">{{ trans('lang.Product in Report') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='manager.report.deposit' ? 'active' : '' }}" href="{{route('manager.report.deposit')}}">{{ trans('lang.Manager Deposit') }}</a></li>
                        </ul>
                    </li>
                    {{-- Gift - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{Route::currentRouteName()=='gifts' ? 'active' : ''}}" href="#"><i data-feather="gift"></i><span class="lan-3">{{ trans('lang.Gifts') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->is('panel/products') ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='manager.gifts' ? 'active' : '' }}" href="{{route('manager.gifts')}}">{{ trans('lang.Gifts') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='manager.gift.create' ? 'active' : '' }}" href="{{route('manager.gift.create')}}">{{ trans('lang.Make a gift') }}</a></li>
                        </ul>
                    </li>
                    {{-- Gift - End--}}


                    {{-- Sale - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success">{{\App\Models\Orders::where('is_delivered',0)->count()}}</label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/orders' ? 'active' : '' }}" href="#"><i data-feather="shopping-bag"></i><span class="lan-3">{{ trans('lang.Order') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'orders' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/orders' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='manager.orders' ? 'active' : '' }}" href="{{route('manager.orders')}}">{{ trans('lang.Sale List') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='manager.order.create' ? 'active' : '' }}" href="{{route('manager.order.create')}}">{{ trans('lang.Add Sale') }}</a></li>
                        </ul>
                    </li>

                    {{-- Sale - End--}}

                    {{-- Doctor - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success">{{\App\Models\User::where('role_id',5)->where('is_active',0)->count()}}</label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/admin/doctors' ? 'active' : '' }}" href="#"><i data-feather="plus-circle"></i><span class="lan-3">{{ trans('lang.Doctors') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'doctors.index' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/doctors' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='manager.doctors' ? 'active' : '' }}" href="{{route('manager.doctors')}}">{{ trans('lang.Doctor List') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='manager.doctor.create' ? 'active' : '' }}" href="{{route('manager.doctor.create')}}">{{ trans('lang.Add Doctor') }}</a></li>
                        </ul>
                    </li>


                            <li class="sidebar-list">
                                <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='manager.manager.profile' ? 'active' : '' }}" href="{{route('manager.manager.profile')}}"><i data-feather="user"></i><span class="lan-3">{{ trans('lang.Manager') }}</span>
                                </a>
                            </li>




                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='manager.payment.percent' ? 'active' : '' }}" href="{{route('manager.payment.percent')}}"><i data-feather="briefcase"></i><span class="lan-3">{{ trans('lang.Payment') }}</span>
                        </a>
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
