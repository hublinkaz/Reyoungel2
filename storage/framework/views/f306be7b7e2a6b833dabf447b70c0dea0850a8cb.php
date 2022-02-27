<?php

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
?>

<div class="sidebar-wrapper">

	<div>
		<div class="logo-wrapper">
			<a href="<?php echo e(route('admin.dashboard')); ?>"><img class="img-fluid for-light" style="width: 70%;" src="<?php echo e(asset('assets/images/logo/logo.png')); ?>" alt=""><img class="img-fluid for-dark" style="width: 70%;" src="<?php echo e(asset('assets/images/logo/logo_dark.png')); ?>" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>

		<div class="logo-icon-wrapper"><a href="<?php echo e(route('admin.dashboard')); ?>"><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo-icon.png')); ?>" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="<?php echo e(route('admin.dashboard')); ?>"><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo-icon.png')); ?>" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>

					<li class="sidebar-list">
						<label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='admin.dashboard' ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>"><i data-feather="home"></i><span class="lan-3"><?php echo e(trans('lang.Dashboards')); ?></span>
                        </a>
					</li>
                    <li class="sidebar-list">
                        <label class="badge badge-success"><?php echo e(\App\Models\OrderDetails::where('is_return',1)->count()==0 ? null : \App\Models\OrderDetails::where('is_return',1)->count()); ?></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='returns' ? 'active' : ''); ?>" href="<?php echo e(route('returns')); ?>"><i data-feather="corner-left-up"></i><span class="lan-3"><?php echo e(trans('lang.Doctor Returns')); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <label class="badge badge-success"><?php echo e(\App\Models\ReturunProductQuery::all()->count()==0 ? null : \App\Models\ReturunProductQuery::all()->count()); ?></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='manager.return.product' ? 'active' : ''); ?>" href="<?php echo e(route('manager.return.product')); ?>"><i data-feather="corner-left-up"></i><span class="lan-3"><?php echo e(trans('lang.Manager Returns')); ?></span>
                        </a>
                    </li>



                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == 'panel/report/doctor' ? 'active' : ''); ?>" href="#"><i data-feather="book-open"></i><span class="lan-3"><?php echo e(trans('lang.Report')); ?></span>
                            <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right'); ?>"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/admin/staffes' ? 'block;' : 'none;'); ?>">
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='report.doctor' ? 'active' : ''); ?>" href="<?php echo e(route('report.doctor')); ?>"><?php echo e(trans('lang.Doctor in Report')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='report.product' ? 'active' : ''); ?>" href="<?php echo e(route('report.product')); ?>"><?php echo e(trans('lang.Product in Report')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='report.manager' ? 'active' : ''); ?>" href="<?php echo e(route('report.manager')); ?>"><?php echo e(trans('lang.general report extract')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='report.deposit' ? 'active' : ''); ?>" href="<?php echo e(route('report.deposit')); ?>"><?php echo e(trans('lang.Manager Deposit')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='report.doctors' ? 'active' : ''); ?>" href="<?php echo e(route('report.doctors')); ?>"><?php echo e(trans('lang.Doctors')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='report.warehouse' ? 'active' : ''); ?>" href="<?php echo e(route('report.warehouse')); ?>"><?php echo e(trans('lang.Warehouse')); ?></a></li>
                        </ul>
                    </li>



                    
                    
                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='products' ? 'active' : ''); ?>" href="#"><i data-feather="box"></i><span class="lan-3"><?php echo e(trans('lang.Products')); ?></span>
                            <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->is('panel/products') ? 'down' : 'right'); ?>"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;'); ?>">
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='products' ? 'active' : ''); ?>" href="<?php echo e(route('products')); ?>"><?php echo e(trans('lang.Product List')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='product.create' ? 'active' : ''); ?>" href="<?php echo e(route('product.create')); ?>"><?php echo e(trans('lang.Add Product')); ?></a></li>
                        </ul>
                    </li>
                    




                    
                    <li class="sidebar-list">
                        <label class="badge badge-success"><?php echo e(\App\Models\GiftQuery::all()->count()==0 ?  null : \App\Models\GiftQuery::all()->count()); ?></label><a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='gifts' ? 'active' : ''); ?>" href="#"><i data-feather="gift"></i><span class="lan-3"><?php echo e(trans('lang.Gifts')); ?></span>
                            <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->is('panel/products') ? 'down' : 'right'); ?>"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;'); ?>">
                            <li> <label  style="    margin-top: -6px;" class="badge badge-success"><?php echo e(\App\Models\GiftQuery::all()->count()==0 ? null : \App\Models\GiftQuery::all()->count()); ?></label><a class="lan-5 <?php echo e(Route::currentRouteName()=='gift.query' ? 'active' : ''); ?>" href="<?php echo e(route('gift.query')); ?>"><?php echo e(trans('lang.Query a gift')); ?></a></li>
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='gifts' ? 'active' : ''); ?>" href="<?php echo e(route('gifts')); ?>"><?php echo e(trans('lang.Gifts')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='gift.create' ? 'active' : ''); ?>" href="<?php echo e(route('gift.create')); ?>"><?php echo e(trans('lang.Make a gift')); ?></a></li>
                        </ul>
                    </li>

                    


                    
                    <li class="sidebar-list">
                        <label class="badge badge-success"><?php echo e(\App\Models\Orders::where('is_delivered',0)->count()==0 ? null : \App\Models\Orders::where('is_delivered',0)->count()); ?></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/orders' ? 'active' : ''); ?>" href="#"><i data-feather="shopping-bag"></i><span class="lan-3"><?php echo e(trans('lang.Order')); ?></span>
                            <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == 'orders' ? 'down' : 'right'); ?>"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/orders' ? 'block;' : 'none;'); ?>">
                            <li> <label  style="margin-top: -6px;" class="badge badge-success"><?php echo e(\App\Models\Orders::where('is_delivered',0)->count()==0 ? null : \App\Models\Orders::where('is_delivered',0)->count()); ?></label><a class="lan-4 <?php echo e(Route::currentRouteName()=='orders' ? 'active' : ''); ?>" href="<?php echo e(route('orders')); ?>"><?php echo e(trans('lang.Sale List')); ?></a></li>
                        </ul>
                    </li>

                    

                    
                    <li class="sidebar-list">
                        <label class="badge badge-success"><?php echo e(\App\Models\User::where('role_id',5)->where('is_active',0)->count()==0 ? null : \App\Models\User::where('role_id',5)->where('is_active',0)->count()); ?></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/admin/doctors' ? 'active' : ''); ?>" href="#"><i data-feather="plus-circle"></i><span class="lan-3"><?php echo e(trans('lang.Doctors')); ?></span>
                            <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == 'doctors.index' ? 'down' : 'right'); ?>"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/admin/doctors' ? 'block;' : 'none;'); ?>">
                            <li><label  style="margin-top: -6px;" class="badge badge-success"><?php echo e(\App\Models\User::where('role_id',5)->where('is_active',0)->count()==0 ? null : \App\Models\User::where('role_id',5)->where('is_active',0)->count()); ?></label><a class="lan-4 <?php echo e(Route::currentRouteName()=='doctors' ? 'active' : ''); ?>" href="<?php echo e(route('doctors')); ?>"><?php echo e(trans('lang.Doctor List')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='doctor.create' ? 'active' : ''); ?>" href="<?php echo e(route('doctor.create')); ?>"><?php echo e(trans('lang.Add Doctor')); ?></a></li>
                        </ul>
                    </li>

                    
                    


                            <li class="sidebar-list">
                                    <label class="badge badge-success"><?php echo e(\App\Models\WarehouseQuery::count()==0 ? null : \App\Models\WarehouseQuery::count()); ?></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/admin/doctors' ? 'active' : ''); ?>" href="#"><i data-feather="briefcase"></i><span class="lan-3"><?php echo e(trans('lang.Managers')); ?></span>
                                        <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == 'doctors.index' ? 'down' : 'right'); ?>"></i></div>
                                    </a>
                                    <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/admin/managers' ? 'block;' : 'none;'); ?>">
                                        <li><label  style="margin-top: -6px;" class="badge badge-success"><?php echo e(\App\Models\WarehouseQuery::count()==0 ? null : \App\Models\WarehouseQuery::count()); ?></label><a class="lan-5 <?php echo e(Route::currentRouteName()=='manager.query' ? 'active' : ''); ?>" href="<?php echo e(route('manager.query')); ?>"><?php echo e(trans('lang.Manager Query')); ?></a></li>
                                        <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='managers' ? 'active' : ''); ?>" href="<?php echo e(route('managers')); ?>"><?php echo e(trans('lang.Manager List')); ?></a></li>
                                        <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='manager.create' ? 'active' : ''); ?>" href="<?php echo e(route('manager.create')); ?>"><?php echo e(trans('lang.Add Manager')); ?></a></li>
                                    </ul>
                                </li>

                    
                        
                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/admin/drivers' ? 'active' : ''); ?>" href="#"><i data-feather="map"></i><span class="lan-3"><?php echo e(trans('lang.Drivers')); ?></span>
                                <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right'); ?>"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/admin/managers' ? 'block;' : 'none;'); ?>">
                                <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='drivers' ? 'active' : ''); ?>" href="<?php echo e(route('drivers')); ?>"><?php echo e(trans('lang.Driver List')); ?></a></li>
                                <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='driver.create' ? 'active' : ''); ?>" href="<?php echo e(route('driver.create')); ?>"><?php echo e(trans('lang.Add Driver')); ?></a></li>
                            </ul>
                        </li>

                        
                        

                            <li class="sidebar-list">
                                    <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/admin/drivers' ? 'active' : ''); ?>" href="#"><i data-feather="users"></i><span class="lan-3"><?php echo e(trans('lang.Staff')); ?></span>
                                        <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right'); ?>"></i></div>
                                    </a>
                                    <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/admin/staffes' ? 'block;' : 'none;'); ?>">
                                        <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='staffes' ? 'active' : ''); ?>" href="<?php echo e(route('staffes')); ?>"><?php echo e(trans('lang.Staff List')); ?></a></li>
                                        <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='staff.create' ? 'active' : ''); ?>" href="<?php echo e(route('staff.create')); ?>"><?php echo e(trans('lang.Add Staff')); ?></a></li>
                                    </ul>
                                </li>

                        
                        



                            <li class="sidebar-list">
                                <label class="badge badge-success"><?php echo e($payment[0]->count==0 ? null : $payment[0]->count); ?></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == 'panel/payments' ? 'active' : ''); ?>" href="#"><i data-feather="book-open"></i><span class="lan-3"><?php echo e(trans('lang.Invoices')); ?></span>
                                    <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == 'driver.index' ? 'down' : 'right'); ?>"></i></div>
                                </a>
                                <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/admin/staffes' ? 'block;' : 'none;'); ?>">
                                    <li><label  style="margin-top: -6px;" class="badge badge-success"><?php echo e($payment[0]->count==0 ? null : $payment[0]->count); ?></label><a class="lan-4 <?php echo e(Route::currentRouteName()=='payments' ? 'active' : ''); ?>" href="<?php echo e(route('payments')); ?>"><?php echo e(trans('lang.Invoices')); ?></a></li>

                                    <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='payment.percent' ? 'active' : ''); ?>" href="<?php echo e(route('payment.percent')); ?>"><?php echo e(trans('lang.Manager Paid')); ?></a></li>
                                </ul>
                            </li>
                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/slides' ? 'active' : ''); ?>" href="#"><i data-feather="box"></i><span class="lan-3"><?php echo e(trans('lang.Slides')); ?></span>
                                <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/slides' ? 'down' : 'right'); ?>"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;'); ?>">
                                <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='slides' ? 'active' : ''); ?>" href="<?php echo e(route('slides')); ?>"><?php echo e(trans('lang.Slide List')); ?></a></li>
                                <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='slide.create' ? 'active' : ''); ?>" href="<?php echo e(route('slide.create')); ?>"><?php echo e(trans('lang.Add Slide')); ?></a></li>
                            </ul>
                        </li>





                    <li class="sidebar-list">
                        <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/blogs' ? 'active' : ''); ?>" href="#"><i data-feather="box"></i><span class="lan-3"><?php echo e(trans('lang.Blog')); ?></span>
                            <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/slides' ? 'down' : 'right'); ?>"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;'); ?>">
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='blogs' ? 'active' : ''); ?>" href="<?php echo e(route('blogs')); ?>"><?php echo e(trans('lang.Blogs List')); ?></a></li>
                            <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='blog.create' ? 'active' : ''); ?>" href="<?php echo e(route('blog.create')); ?>"><?php echo e(trans('lang.Add Blogs')); ?></a></li>
                        </ul>
                    </li>
                        

                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/settings/doctor' ? 'active' : ''); ?>" href="#"><i data-feather="settings"></i><span class="lan-3"><?php echo e(trans('lang.Settings')); ?></span>
                                <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/settings/doctor' ? 'down' : 'right'); ?>"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;'); ?>">
                                <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='front.doctors' ? 'active' : ''); ?>" href="<?php echo e(route('front.doctors')); ?>"><?php echo e(trans('lang.Doctors')); ?></a></li>
                                <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='front.doctors.create' ? 'active' : ''); ?>" href="<?php echo e(route('front.doctors.create')); ?>"><?php echo e(trans('lang.Add Doctor')); ?></a></li>
                                <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='banners' ? 'active' : ''); ?>" href="<?php echo e(route('banners')); ?>"><?php echo e(trans('lang.Banners')); ?></a></li>
                                <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='settings' ? 'active' : ''); ?>" href="<?php echo e(route('settings')); ?>"><?php echo e(trans('lang.Panel Settings')); ?></a></li>
                                <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='setting.create' ? 'active' : ''); ?>" href="<?php echo e(route('setting.create')); ?>"><?php echo e(trans('lang.Add Panel Settings')); ?></a></li>
                                <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='pages' ? 'active' : ''); ?>" href="<?php echo e(route('pages')); ?>"><?php echo e(trans('lang.Pages')); ?></a></li>

                            </ul>
                        </li>



                        <li class="sidebar-list">
                            <label class="badge badge-success"></label><a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/warehouse' ? 'active' : ''); ?>" href="#"><i data-feather="archive"></i><span class="lan-3"><?php echo e(trans('lang.All Products')); ?></span>
                                <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/warehouse' ? 'down' : 'right'); ?>"></i></div>
                            </a>
                            <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;'); ?>">
                                <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='warehouse' ? 'active' : ''); ?>" href="<?php echo e(route('warehouse')); ?>"><?php echo e(trans('lang.All Warehouse')); ?></a></li>
                                <!--<li><a class="lan-5 <?php echo e(Route::currentRouteName()=='warehouse.doctors' ? 'active' : ''); ?>" href="<?php echo e(route('warehouse.doctors')); ?>"><?php echo e(trans('lang.Doctors Deposit')); ?></a></li>-->
                                <li><a class="lan-5 <?php echo e(Route::currentRouteName()=='warehouse.managers' ? 'active' : ''); ?>" href="<?php echo e(route('warehouse.managers')); ?>"><?php echo e(trans('lang.Manager Deposit')); ?></a></li>
                            </ul>
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
<?php /**PATH C:\xampp\htdocs\resources\views/admin/layouts/simple/sidebar.blade.php ENDPATH**/ ?>