<?php $__env->startSection('title', 'Product list'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/owlcarousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/rating.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Gift List')); ?></h3>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th><?php echo e(trans('lang.id')); ?></th>
                                    <th><?php echo e(trans('lang.Doctor')); ?></th>
                                    <th><?php echo e(trans('lang.Product')); ?></th>
                                    <th><?php echo e(trans('lang.Gift by')); ?></th>

                                    <th><?php echo e(trans('lang.History')); ?></th>
                                    <th><?php echo e(trans('lang.Action')); ?></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $gifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a ><?php echo e($gift->gift_id); ?></a></td>
                                        <td><a ><?php echo e($gift->doctor_first_name); ?> <?php echo e($gift->doctor_last_name); ?></a></td>
                                        <td><a ><?php echo e($gift->{'name_'.app()->getLocale()}); ?></a></td>
                                        <td><a ><?php echo e($gift->seller_first_name); ?> <?php echo e($gift->seller_last_name); ?></a></td>
                                        <td><a ><?php echo e($gift->created_at); ?></a></td>
                                        <td>
                                            <form action="<?php echo e(route('gift.query.post',$gift->gift_id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>

                                                <select  style="color:#FF6800" required id="status" name="status" class="form-control"  title="Select Manager...">

                                                            <option selected value="1"><?php echo e(trans('lang.With approval ')); ?></option>
                                                            <option value="0"><?php echo e(trans('lang.Cancel')); ?></option>


                                                </select>



                                                <input  type="hidden"  name="gift_id" id="gift_id" value="<?php echo e($gift->gift_id); ?>" >


                                                        <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs"><?php echo e(trans('lang.Change')); ?></button>

                                            </form>

                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/rating/jquery.barrating.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/rating/rating-script.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/owlcarousel/owl.carousel.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/ecommerce.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/product-list-custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/gift/gift_query.blade.php ENDPATH**/ ?>