<?php

    $notif=\App\Models\Orders::where('is_delivered',0)->groupBy('is_delivered')->count();
?>
<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="<?php echo e(route('manager.dashboard')); ?>"><img class="img-fluid for-light" style="width: 70%;" src="<?php echo e(asset('assets/images/logo/logo.png')); ?>" alt=""><img class="img-fluid for-dark" style="width: 70%;" src="<?php echo e(asset('assets/images/logo/logo_dark.png')); ?>" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="<?php echo e(route('manager.dashboard')); ?>"><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo-icon.png')); ?>" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="<?php echo e(route('manager.dashboard')); ?>"><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo-icon.png')); ?>" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>







					<li class="sidebar-list">
						<label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='manager.dashboard' ? 'active' : ''); ?>" href="<?php echo e(route('manager.dashboard')); ?>"><i data-feather="home"></i><span class="lan-3"><?php echo e(trans('lang.Dashboards')); ?></span>
                        </a>
					</li>
                    



                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='manager.manager.warehouse' ? 'active' : ''); ?>" href="<?php echo e(route('manager.manager.warehouse')); ?>"><i data-feather="box"></i><span class="lan-3"><?php echo e(trans('lang.Warehouse')); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='manager.manager.all_deposits' ? 'active' : ''); ?>" href="<?php echo e(route('manager.manager.all_deposits')); ?>"><i data-feather="box"></i><span class="lan-3"><?php echo e(trans('lang.All Warehouse')); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='manager.manager.deposit' ? 'active' : ''); ?>" href="<?php echo e(route('manager.manager.deposit')); ?>"><i data-feather="truck"></i><span class="lan-3"><?php echo e(trans('lang.Deposit')); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == 'panel/report/doctor' ? 'active' : ''); ?>" href="#"><i data-feather="book-open"></i><span class="lan-3"><?php echo e(trans('lang.Report')); ?></span>
                            <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right'); ?>"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/admin/staffes' ? 'block;' : 'none;'); ?>">
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='manager.report.doctor' ? 'active' : ''); ?>" href="<?php echo e(route('manager.report.doctor')); ?>"><?php echo e(trans('lang.Doctor in Report')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='manager.report.product' ? 'active' : ''); ?>" href="<?php echo e(route('manager.report.product')); ?>"><?php echo e(trans('lang.Product in Report')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='manager.report.deposit' ? 'active' : ''); ?>" href="<?php echo e(route('manager.report.deposit')); ?>"><?php echo e(trans('lang.Manager Deposit')); ?></a></li>
                        </ul>
                    </li>
                    
                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='gifts' ? 'active' : ''); ?>" href="#"><i data-feather="gift"></i><span class="lan-3"><?php echo e(trans('lang.Gifts')); ?></span>
                            <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->is('panel/products') ? 'down' : 'right'); ?>"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;'); ?>">
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='manager.gifts' ? 'active' : ''); ?>" href="<?php echo e(route('manager.gifts')); ?>"><?php echo e(trans('lang.Gifts')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='manager.gift.create' ? 'active' : ''); ?>" href="<?php echo e(route('manager.gift.create')); ?>"><?php echo e(trans('lang.Make a gift')); ?></a></li>
                        </ul>
                    </li>
                    


                    
                    <li class="sidebar-list">
                        <label class="badge badge-success"><?php echo e(\App\Models\Orders::where('is_delivered',0)->count()); ?></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/orders' ? 'active' : ''); ?>" href="#"><i data-feather="shopping-bag"></i><span class="lan-3"><?php echo e(trans('lang.Order')); ?></span>
                            <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == 'orders' ? 'down' : 'right'); ?>"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/orders' ? 'block;' : 'none;'); ?>">
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='manager.orders' ? 'active' : ''); ?>" href="<?php echo e(route('manager.orders')); ?>"><?php echo e(trans('lang.Sale List')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='manager.order.create' ? 'active' : ''); ?>" href="<?php echo e(route('manager.order.create')); ?>"><?php echo e(trans('lang.Add Sale')); ?></a></li>
                        </ul>
                    </li>

                    

                    
                    <li class="sidebar-list">
                        <label class="badge badge-success"><?php echo e(\App\Models\User::where('role_id',5)->where('is_active',0)->count()); ?></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/admin/doctors' ? 'active' : ''); ?>" href="#"><i data-feather="plus-circle"></i><span class="lan-3"><?php echo e(trans('lang.Doctors')); ?></span>
                            <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == 'doctors.index' ? 'down' : 'right'); ?>"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/admin/doctors' ? 'block;' : 'none;'); ?>">
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='manager.doctors' ? 'active' : ''); ?>" href="<?php echo e(route('manager.doctors')); ?>"><?php echo e(trans('lang.Doctor List')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='manager.doctor.create' ? 'active' : ''); ?>" href="<?php echo e(route('manager.doctor.create')); ?>"><?php echo e(trans('lang.Add Doctor')); ?></a></li>
                        </ul>
                    </li>


                            <li class="sidebar-list">
                                <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='manager.manager.profile' ? 'active' : ''); ?>" href="<?php echo e(route('manager.manager.profile')); ?>"><i data-feather="user"></i><span class="lan-3"><?php echo e(trans('lang.Manager')); ?></span>
                                </a>
                            </li>




                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='manager.payment.percent' ? 'active' : ''); ?>" href="<?php echo e(route('manager.payment.percent')); ?>"><i data-feather="briefcase"></i><span class="lan-3"><?php echo e(trans('lang.Payment')); ?></span>
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
<?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/manager/layouts/simple/sidebar.blade.php ENDPATH**/ ?>