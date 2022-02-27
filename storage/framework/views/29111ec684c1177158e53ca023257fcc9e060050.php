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
                                    <th>İD</th>
                                    <th><?php echo e(trans('lang.Manager')); ?></th>
                                    <th><?php echo e(trans('lang.Doctor')); ?></th>
                                    <th><?php echo e(trans('lang.Product')); ?></th>

                   <th><?php echo e(trans('lang.Action')); ?></th>


                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="/admin-panel/orders/detail/<?php echo e($product->order_id); ?>"><?php echo e($product->order_id); ?></a></td>
                                        <td><?php echo e($product->manager_first_name); ?> <?php echo e($product->manager_last_name); ?></td>
                                        <td><?php echo e($product->doctor_first_name); ?> <?php echo e($product->doctor_last_name); ?></td>
                                        <td><?php echo e($product->product_name); ?></td>

                                        <td>
                                            <form action="<?php echo e(route('return.post.query')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <select  style="color:#FF6800" required id="value" name="value" class="form-control" >
                                                            <option selected value="1"><?php echo e(trans('lang.Return')); ?></option>
                                                            <option value="2"><?php echo e(trans('lang.Cancel')); ?></option>

                                                </select>

                                                <input  type="hidden"  name="order_id" id="order_id" value="<?php echo e($product->order_id); ?>" >
                                                <input  type="hidden"  name="order_detail_id" id="order_detail_id" value="<?php echo e($product->order_detail_id); ?>" >
                                                <input  type="hidden"  name="product_id" id="product_id" value="<?php echo e($product->product_id); ?>" >
                                                <input  type="hidden"  name="manager_id" id="manager_id" value="<?php echo e($product->manager_id); ?>" >
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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/order/return.blade.php ENDPATH**/ ?>