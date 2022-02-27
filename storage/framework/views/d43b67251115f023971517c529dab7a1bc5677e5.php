<?php $__env->startSection('title', 'Product list'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/owlcarousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/rating.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <?php if(\Illuminate\Support\Facades\Auth::user()->role_id==1 or \Illuminate\Support\Facades\Auth::user()->role_id==3 ): ?>
        <div class="row">
            <div class="col-6">
                <div class="card o-hidden">
                    <div class="bg-secondary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                            <div class="media-body">
                                <span class="m-0"><?php echo e(trans('lang.Count')); ?></span>
                                
                                <?php if(empty($total[0]->total_qty)): ?>
                                <h4 class="mb-0 counter">0</h4>

                                <?php else: ?>
                                <h4 class="mb-0 counter"><?php echo e($total[0]->total_qty); ?></h4>

                                <?php endif; ?>
                                <i class="icon-bg" data-feather="shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card o-hidden">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="trending-up"></i></div>
                            <div class="media-body">
                                <span class="m-0"><?php echo e(trans('lang.Price')); ?></span>
                                <h4 class="mb-0 ">
                               <?php if(empty($total[0]->total_price)): ?>
                                    0
                                <?php else: ?>
                                    <?php echo e($total[0]->total_price); ?> ₼

                                <?php endif; ?>
                                    
                                </h4>
                                <i class="icon-bg" data-feather="star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
















































            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e(trans('lang.Warehouse')); ?></h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-spin fa-cog"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-status table-responsive">
                            <table class="table table-bordernone">
                                <thead>
                                <tr>
                                    <th scope="col"><?php echo e(trans('lang.Product Name')); ?></th>
                                    <th scope="col"><?php echo e(trans('lang.Manager Warehouse')); ?></th>
                                    <th scope="col"><?php echo e(trans('lang.Doctor Deposite')); ?></th>
                                    <th scope="col"><?php echo e(trans('lang.Total Warhouse')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td class="f-w-600"><?php echo e($new->name_az); ?> </td>

                                        <td>
                                            <div class="span badge rounded-pill pill-badge-secondary">
                                 <?php if(empty($new->warehouse_qty)): ?>
                                    0
                                <?php else: ?>
                                <?php echo e($new->warehouse_qty); ?>


                                <?php endif; ?>

                                            </div>

                                        </td>
                                        <td class="f-w-600">
                                            <div class="span badge rounded-pill pill-badge-secondary">
                                                <?php if(empty($new->doctor_qty)): ?>
                                                    0
                                                <?php else: ?>
                                                <?php echo e($new->doctor_qty); ?>

                
                                                <?php endif; ?>
                                            </div>

                                        </td>
                                        <td class="f-w-600">
                                            <div class="span badge rounded-pill pill-badge-secondary">
                                             <?php if(empty($new->total_qty)): ?>
                                                    0
                                                <?php else: ?>
                                                <?php echo e($new->total_qty); ?>

                
                                                <?php endif; ?>
                                                
                                            </div>

                                        </td>


                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/rating/jquery.barrating.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/rating/rating-script.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/owlcarousel/owl.carousel.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/ecommerce.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/product-list-custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/warehouse/manager.blade.php ENDPATH**/ ?>