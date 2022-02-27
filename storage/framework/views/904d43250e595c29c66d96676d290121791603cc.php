<?php $__env->startSection('title', 'User Profile'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/photoswipe.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatable-extension.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3>Manager Profile</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item"><?php echo e(trans('lang.Managers')); ?></li>
    <li class="breadcrumb-item active"><?php echo e(trans('lang.Manager Profile')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">
                <!-- user profile first-style start-->
                <div class="col-sm-12">
                    <div class="card hovercard text-center">

                        <div class="info">
                            <div class="row">
                                <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-envelope"></i>  <?php echo e(trans('lang.Email')); ?> </h6>
                                                <span><?php echo e($manager->email); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-calendar"></i>   <?php echo e(trans('lang.BOD')); ?></h6>
                                                <span><?php echo e($manager->birth_date); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                    <div class="user-designation">
                                        <div class="title"><a target="_blank" href=""><?php echo e($manager->first_name); ?> <?php echo e($manager->last_name); ?></a></div>
                                        <div class="desc mt-2"><?php echo e(trans('lang.Manager')); ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-phone"></i>  <?php echo e(trans('lang.Contact Us')); ?> </h6>
                                                <span><?php echo e($manager->phone); ?></span>
                                            </div>
                                        </div>






                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <?php if(empty($manager->description)): ?>
                                    <span>Ətraflı Məlumat Yoxdur</span>

                                <?php else: ?>
                                    <span><?php echo e($manager->description); ?></span>

                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="">
                                <a class="btn btn-primary" href="/admin-panel/manager/deposit/<?php echo e($manager->user_id); ?>"><?php echo e(trans('lang.Deposit')); ?></a>
                                <a class="btn btn-primary" href="/admin-panel/export/<?php echo e($manager->user_id); ?>"><?php echo e(trans('lang.Extract')); ?></a>
                                <a class="btn btn-success" href="/admin-panel/manager/warehouse/<?php echo e($manager->user_id); ?>"><?php echo e(trans('lang.Warehouse')); ?></a>
                                <a class="btn btn-success" href="/admin-panel/pdf/create/<?php echo e($manager->user_id); ?>"><?php echo e(trans('lang.Report')); ?></a>
                                <a class="btn btn-success" href="<?php echo e(route('manager.deposit.all',$manager->user_id)); ?>"><?php echo e(trans('lang.All')); ?></a>
                            </div>

                        </div>
                    </div>
                </div>
                <h3><?php echo e(trans('lang.Orders')); ?></h3>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="dt-ext table-responsive">
                                <table class="display" id="export-button">

                                    <thead>
                                    <tr>
                                        <th><?php echo e(trans('lang.iD')); ?></th>
                                        <th><?php echo e(trans('lang.Name')); ?></th>
                                        <th><?php echo e(trans('lang.Amount')); ?></th>
                                        <th><?php echo e(trans('lang.Doctor Paid')); ?></th>
                                        <th><?php echo e(trans('lang.Doctor')); ?></th>
                                        <th><?php echo e(trans('lang.Date')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($order->id); ?> </td>
                                            <td><?php echo e($order->name_az); ?> </td>
                                            <td><?php echo e($order->amount); ?> </td>
                                            <td><?php echo e($order->paid); ?> </td>
                                            <td><a href="/admin-panel/doctor/<?php echo e($order->doctor_id); ?>"><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></a></td>
                                            <td><?php echo e($order->created_at); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th><?php echo e(trans('lang.iD')); ?></th>
                                        <th><?php echo e(trans('lang.Amount')); ?></th>
                                        <th><?php echo e(trans('lang.Doctor Paid')); ?></th>
                                        <th><?php echo e(trans('lang.Manager Paid')); ?></th>
                                        <th><?php echo e(trans('lang.Manager')); ?></th>
                                        <th><?php echo e(trans('lang.Date')); ?></th>

                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/counter/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/photoswipe/photoswipe.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/photoswipe/photoswipe-ui-default.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/photoswipe/photoswipe.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/manager/profile.blade.php ENDPATH**/ ?>