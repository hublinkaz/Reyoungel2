<?php $__env->startSection('title', 'Product list'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/owlcarousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/rating.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Return List')); ?></h3>
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
                                    <th><?php echo e(trans('lang.Manager')); ?></th>
                                    <th><?php echo e(trans('lang.Product')); ?></th>

                                    <th><?php echo e(trans('lang.Qty')); ?></th>

                   <th><?php echo e(trans('lang.Action')); ?></th>


                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $returns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="<?php echo e(route('manager.warehouse',$return->manager_id)); ?>"><?php echo e($return->first_name); ?> <?php echo e($return->last_name); ?></a></td>
                                        <td><?php echo e($return->name_az); ?></td>
                                        <td><?php echo e($return->qty); ?> </td>

                                        <td>
                                            <form action="<?php echo e(route('manager.return.product.update')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <select  style="color:#FF6800" required id="value" name="value" class="form-control" >
                                                            <option selected value="1"><?php echo e(trans('lang.Return')); ?></option>
                                                            <option value="2"><?php echo e(trans('lang.Cancel')); ?></option>

                                                </select>


                                                <input  type="hidden"  name="return" id="return" value="<?php echo e($return->id); ?>" >
                                                <input  type="hidden"  name="manager_id" id="manager_id" value="<?php echo e($return->manager_id); ?>" >
                                                <input  type="hidden"  name="product_id" id="product_id" value="<?php echo e($return->product_id); ?>">
                                                <input  type="hidden"  name="qty" id="qty" value="<?php echo e($return->qty); ?>">
                                                <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs"><?php echo e(trans('lang.Approval')); ?></button>
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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/manager/return.blade.php ENDPATH**/ ?>