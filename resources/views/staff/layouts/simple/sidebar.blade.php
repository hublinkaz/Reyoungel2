@php

    $notif=\App\Models\Orders::where('is_delivered',0)->groupBy('is_delivered')->count();
@endphp
<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{route('staff.dashboard')}}"><img class="img-fluid for-light" style="width: 70%;" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" style="width: 70%;" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('staff.dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{route('staff.dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
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
						<label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='staff.dashboard' ? 'active' : '' }}" href="{{route('staff.dashboard')}}"><i data-feather="home"></i><span class="lan-3">{{ trans('lang.Dashboards') }}</span>
                        </a>
					</li>
                    {{-- Dashboard - End--}}
                    {{-- Products - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{Route::currentRouteName()=='staff.products' ? 'active' : ''}}" href="#"><i data-feather="box"></i><span class="lan-3">{{ trans('lang.Products') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->is('staff-panel/products') ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == 'staff-panel/products' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='staff.products' ? 'active' : '' }}" href="{{route('staff.products')}}">{{ trans('lang.Product List') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='staff.product.create' ? 'active' : '' }}" href="{{route('staff.product.create')}}">{{ trans('lang.Add Product') }}</a></li>
                        </ul>
                    </li>
                    {{-- Products - End--}}




                    {{-- Gift - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{Route::currentRouteName()=='gifts' ? 'active' : ''}}" href="#"><i data-feather="gift"></i><span class="lan-3">{{ trans('lang.Gifts') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->is('panel/products') ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='staff.gifts' ? 'active' : '' }}" href="{{route('staff.gifts')}}">{{ trans('lang.Gifts') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='staff.gift.create' ? 'active' : '' }}" href="{{route('staff.gift.create')}}">{{ trans('lang.Make a gift') }}</a></li>
                        </ul>
                    </li>

                    {{-- Gift - End--}}


                    {{-- Sale - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success">{{\App\Models\Orders::where('is_delivered',0)->count()}}</label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == 'staff.orders' ? 'active' : '' }}" href="#"><i data-feather="shopping-bag"></i><span class="lan-3">{{ trans('lang.Order') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'staff.orders' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/orders' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='staff.orders' ? 'active' : '' }}" href="{{route('staff.orders')}}">{{ trans('lang.Sale List') }}</a></li>
{{--                            <li><a class="lan-5 {{ Route::currentRouteName()=='order.create' ? 'active' : '' }}" href="{{route('order.create')}}">{{ trans('lang.Add Sale') }}</a></li>--}}
                        </ul>
                    </li>

                    {{-- Sale - End--}}

                    {{-- Doctor - Start--}}
                    <li class="sidebar-list">
                        <label class="badge badge-success">{{\App\Models\User::where('role_id',5)->where('is_active',0)->count()}}</label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == 'staff.doctors' ? 'active' : '' }}" href="#"><i data-feather="plus-circle"></i><span class="lan-3">{{ trans('lang.Doctors') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'staff.doctors.index' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/doctors' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='staff.doctors' ? 'active' : '' }}" href="{{route('staff.doctors')}}">{{ trans('lang.Doctor List') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='staff.doctor.create' ? 'active' : '' }}" href="{{route('staff.doctor.create')}}">{{ trans('lang.Add Doctor') }}</a></li>
                        </ul>
                    </li>

                    {{-- Doctor - End--}}
                    {{-- Managers - Start--}}


                            <li class="sidebar-list">
                                    <label class="badge badge-success">{{\App\Models\Warehouse::where('status',0)->count()}}</label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == 'staff.doctors' ? 'active' : '' }}" href="#"><i data-feather="briefcase"></i><span class="lan-3">{{ trans('lang.Managers') }}</span>
                                        <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'staff.doctors.index' ? 'down' : 'right' }}"></i></div>
                                    </a>
                                    <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/managers' ? 'block;' : 'none;' }}">
                                        <li><a class="lan-4 {{ Route::currentRouteName()=='staff.managers' ? 'active' : '' }}" href="{{route('staff.managers')}}">{{ trans('lang.Manager List') }}</a></li>
                                        <li><a class="lan-5 {{ Route::currentRouteName()=='staff.manager.create' ? 'active' : '' }}" href="{{route('staff.manager.create')}}">{{ trans('lang.Add Manager') }}</a></li>
                                        <li><a class="lan-5 {{ Route::currentRouteName()=='staff.manager.query' ? 'active' : '' }}" href="{{route('staff.manager.query')}}">{{ trans('lang.Manager Query') }}</a></li>
                                    </ul>
                                </li>

                    {{-- Managers - End--}}
                        {{-- Deliverers - Start--}}
                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/admin/drivers' ? 'active' : '' }}" href="#"><i data-feather="map"></i><span class="lan-3">{{ trans('lang.Drivers') }}</span>
                                <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right' }}"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/managers' ? 'block;' : 'none;' }}">
                                <li><a class="lan-4 {{ Route::currentRouteName()=='staff.drivers' ? 'active' : '' }}" href="{{route('staff.drivers')}}">{{ trans('lang.Driver List') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='staff.driver.create' ? 'active' : '' }}" href="{{route('staff.driver.create')}}">{{ trans('lang.Add Driver') }}</a></li>
                            </ul>
                        </li>

                        {{-- Deliverers - End--}}
                        {{-- Staff - Start--}}

{{--                            <li class="sidebar-list">--}}
{{--                                    <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/admin/drivers' ? 'active' : '' }}" href="#"><i data-feather="users"></i><span class="lan-3">{{ trans('lang.Staff') }}</span>--}}
{{--                                        <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == 'staff.driver.index' ? 'down' : 'right' }}"></i></div>--}}
{{--                                    </a>--}}
{{--                                    <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/admin/staffes' ? 'block;' : 'none;' }}">--}}
{{--                                        <li><a class="lan-4 {{ Route::currentRouteName()=='staff.staffes' ? 'active' : '' }}" href="{{route('staff.staffes')}}">{{ trans('lang.Staff List') }}</a></li>--}}
{{--                                        <li><a class="lan-5 {{ Route::currentRouteName()=='staff.staff.create' ? 'active' : '' }}" href="{{route('staff.create')}}">{{ trans('lang.Add Staff') }}</a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}

                        {{-- Staff - End--}}
                        {{-- Invoices - Start--}}




                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/slides' ? 'active' : '' }}" href="#"><i data-feather="box"></i><span class="lan-3">{{ trans('lang.Slides') }}</span>
                                <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/slides' ? 'down' : 'right' }}"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                                <li><a class="lan-4 {{ Route::currentRouteName()=='staff.slides' ? 'active' : '' }}" href="{{route('staff.slides')}}">{{ trans('lang.Slide List') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='staff.slide.create' ? 'active' : '' }}" href="{{route('staff.slide.create')}}">{{ trans('lang.Slide add') }}</a></li>
                            </ul>
                        </li>
                        {{-- Settings - Start--}}

                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/settings/doctor' ? 'active' : '' }}" href="#"><i data-feather="settings"></i><span class="lan-3">{{ trans('lang.Settings') }}</span>
                                <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/settings/doctor' ? 'down' : 'right' }}"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                                <li><a class="lan-4 {{ Route::currentRouteName()=='staff.front.doctors' ? 'active' : '' }}" href="{{route('staff.front.doctors')}}">{{ trans('lang.Doctors') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='staff.front.doctors.create' ? 'active' : '' }}" href="{{route('staff.front.doctors.create')}}">{{ trans('lang.Add Doctor') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='staff.banners' ? 'active' : '' }}" href="{{route('staff.banners')}}">{{ trans('lang.Banners') }}</a></li>
                            </ul>
                        </li>


                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/blogs' ? 'active' : '' }}" href="#"><i data-feather="box"></i><span class="lan-3">{{ trans('lang.Blog') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/slides' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='staff.blogs' ? 'active' : '' }}" href="{{route('staff.blogs')}}">{{ trans('lang.Blogs List') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName()=='staff.blog.create' ? 'active' : '' }}" href="{{route('staff.blog.create')}}">{{ trans('lang.Blogs Product') }}</a></li>
                        </ul>
                    </li>

                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/warehouse' ? 'active' : '' }}" href="#"><i data-feather="archive"></i><span class="lan-3">{{ trans('lang.Warehouse') }}</span>
                                <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/warehouse' ? 'down' : 'right' }}"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
                                <li><a class="lan-4 {{ Route::currentRouteName()=='staff.warehouse' ? 'active' : '' }}" href="{{route('staff.warehouse')}}">{{ trans('lang.Warehouse') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='staff.warehouse.doctors' ? 'active' : '' }}" href="{{route('staff.warehouse.doctors')}}">{{ trans('lang.Doctors') }}</a></li>
                                <li><a class="lan-5 {{ Route::currentRouteName()=='staff.warehouse.managers' ? 'active' : '' }}" href="{{route('staff.warehouse.managers')}}">{{ trans('lang.Managers') }}</a></li>
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
