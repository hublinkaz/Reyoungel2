<?php $__env->startSection('title', 'Product list'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/owlcarousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/rating.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Sales List')); ?></h3>
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
                                    <th>ID</th>
                                    <th><?php echo e(trans('lang.Doctor')); ?></th>
                                    <th><?php echo e(trans('lang.Manager')); ?></th>
                                    <th><?php echo e(trans('lang.Driver')); ?></th>

                   <th><?php echo e(trans('lang.Action')); ?></th>
                                    <th><?php echo e(trans('lang.Date')); ?></th>
                                    <th><?php echo e(trans('lang.Invoice')); ?></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="/admin-panel/orders/detail/<?php echo e($product->order_id); ?>"><?php echo e($product->order_id); ?></a></td>
                                        <td><a href="/admin-panel/doctor/<?php echo e($product->doctor_id); ?>"><?php echo e($product->doctor_first_name); ?> <?php echo e($product->doctor_last_name); ?></a></td>
                                        <td><a href="/admin-panel/manager/<?php echo e($product->manager_id); ?>"><?php echo e($product->manager_first_name); ?> <?php echo e($product->manager_last_name); ?></a></td>
                                        <td><?php echo e($product->driver_first_name); ?> <?php echo e($product->driver_last_name); ?></td>

                                        <td>
                                            <form action="<?php echo e(route('order.status',$product->order_id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>

                                                        <select  style="color:#FF6800" required id="is_delivered" name="is_delivered" class="form-control"  title="Select Manager...">
                                                            <?php if($product->is_delivered===0): ?>
                                                            <?php endif; ?>
                                                            <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($product->is_delivered===$stat->id): ?>
                                                                        <option selected value="<?php echo e($stat->id); ?>"><?php echo e($stat->{'status_'.app()->getLocale()}); ?></option>
                                                                    <?php else: ?>
                                                                        <option value="<?php echo e($stat->id); ?>"><?php echo e($stat->{'status_'.app()->getLocale()}); ?></option>
                                                                    <?php endif; ?>

                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </select>



                                                <input  type="hidden"  name="order_id" id="order_id" value="<?php echo e($product->order_id); ?>" >

                                                <?php if(\Illuminate\Support\Facades\Auth::user()->role_id ==1 or \Illuminate\Support\Facades\Auth::user()->role_id ==3): ?>

                                                     <?php if($product->is_delivered === 3): ?>
                                                        <button type="submit" class="form-control btn btn-success btn-xs"  disabled data-original-title="btn btn-success btn-xs"><?php echo e(trans('lang.Change')); ?></button>

                                                    <?php else: ?>
                                                        <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs"><?php echo e(trans('lang.Change')); ?></button>
                                                    <?php endif; ?>
                                              <?php endif; ?>
                                            </form>

                                        </td>
                                        <td><?php echo e($product->order_created_at); ?></td>
                                        <td><a class="btn btn-success " href="<?php echo e(route('order.invoice',$product->order_id)); ?>"><?php echo e(trans('lang.Report')); ?></a></td>

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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/order/index.blade.php ENDPATH**/ ?>