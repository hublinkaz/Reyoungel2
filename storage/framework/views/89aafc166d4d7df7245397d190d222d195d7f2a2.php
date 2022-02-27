<?php $__env->startSection('title', 'User Profile'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/photoswipe.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatable-extension.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Doctor Profile')); ?></h3>
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
                                                <h6><i class="fa fa-envelope"></i><?php echo e(trans('lang.Email')); ?></h6>
                                                <span><?php echo e($doctor->email); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-calendar"></i> <?php echo e(trans('lang.Birth Day')); ?></h6>
                                                <span><?php echo e($doctor->birth_date); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                    <div class="user-designation">
                                        <div class="title"><a target="_blank" href=""><?php echo e($doctor->first_name); ?> <?php echo e($doctor->last_name); ?></a></div>
                                        <div class="desc mt-2">Doctor</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-phone"></i> <?php echo e(trans('lang.Contact')); ?> </h6>
                                                <span><?php echo e($doctor->phone); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-location-arrow"></i><?php echo e(trans('lang.WorkPlace')); ?></h6>
                                                <span><?php echo e($doctor->location); ?></span>
                                                <br>
                                                <span><?php echo e($doctor->workplace); ?></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="">
                                <?php echo csrf_field(); ?>
                                <a id="mapchange"  data-token="<?php echo e(csrf_token()); ?>" data-id="<?php echo e($doctor->user_id); ?>"  class="btn btn-danger-gradien"><?php echo e(trans('lang.Set Location')); ?></a>
                                <a class="btn btn-primary" href="/manager-panel/doctor/deposit/<?php echo e($doctor->user_id); ?>"><?php echo e(trans('lang.Deposit')); ?></a>
                                <a class="btn btn-primary" href="/manager-panel/doctor/orders/<?php echo e($doctor->user_id); ?>"><?php echo e(trans('lang.Orders')); ?></a>

                                <a class="btn btn-success" href="<?php echo e($maplink); ?>"><?php echo e(trans('lang.Location')); ?></a>

                            </div>

                        </div>
                    </div>
                </div>
                <h3><?php echo e(trans('lang.Payments')); ?></h3>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="dt-ext table-responsive">
                                <table class="display" id="export-button">

                                    <thead>
                                    <tr>
                                        <th><?php echo e(trans('lang.iD')); ?></th>
                                        <th><?php echo e(trans('lang.Amount')); ?></th>
                                        <th><?php echo e(trans('lang.Doctor Paid')); ?></th>
                                        <?php if(\Illuminate\Support\Facades\Auth::user()->role_id == 1 or \Illuminate\Support\Facades\Auth::user()->role_id == 2): ?>
                                            <th><?php echo e(trans('lang.Manager Paid')); ?></th>

                                        <?php endif; ?>
                                        <th><?php echo e(trans('lang.Manager')); ?></th>
                                        <th><?php echo e(trans('lang.Date')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><a href="/manager-panel/orders/detail/<?php echo e($payment->orderid); ?>"><?php echo e($payment->od_id); ?></a></td>
                                            <td><?php echo e($payment->amount); ?> </td>
                                            <td><?php echo e($payment->doctor_paid); ?> </td>
                                            <?php if(\Illuminate\Support\Facades\Auth::user()->role_id == 1 or \Illuminate\Support\Facades\Auth::user()->role_id == 2): ?>
                                                <td><?php echo e($payment->manager_paid); ?> </td>
                                            <?php endif; ?>

                                            <td><a href="/manager-panel/profile"><?php echo e($payment->manager_first_name); ?> <?php echo e($payment->manager_last_name); ?></a></td>
                                            <td><?php echo e($payment->doctor_paid_created); ?></td>
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
                </div></div>

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

<?php echo $__env->make('manager.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/manager/doctor/profile.blade.php ENDPATH**/ ?>