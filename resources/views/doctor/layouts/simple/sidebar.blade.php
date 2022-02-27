<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{route('doctor.dashboard')}}"><img class="img-fluid for-light" style="width: 70%;" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" style="width: 70%;" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('doctor.dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{route('doctor.dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>

					<li class="sidebar-list">
						<label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='doctor.dashboard' ? 'active' : '' }}" href="{{route('doctor.dashboard')}}"><i data-feather="home"></i><span class="lan-3">{{ trans('lang.Dashboards') }}</span>
                        </a>
					</li>
                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='doctor.gifts' ? 'active' : '' }}" href="{{route('doctor.gifts')}}"><i data-feather="gift"></i><span class="lan-3">{{ trans('lang.Gifts') }}</span>
                        </a>
                    </li>


                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='doctor.doctor.profile' ? 'active' : '' }}" href="{{route('doctor.doctor.profile')}}"><i data-feather="user"></i><span class="lan-3">{{ trans('lang.Cabinet') }}</span>
                            </a>
                        </li>

                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='doctor.doctor.deposit' ? 'active' : '' }}" href="{{route('doctor.doctor.deposit')}}"><i data-feather="archive"></i><span class="lan-3">{{ trans('lang.Deposit') }}</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title {{ Route::currentRouteName()=='doctor.doctor.orders' ? 'active' : '' }}" href="{{route('doctor.doctor.orders')}}"><i data-feather="book-open"></i><span class="lan-3">{{ trans('lang.Orders') }}</span>
                        </a>
                    </li>

                <br>
                <br>
                <br>

			</ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>
