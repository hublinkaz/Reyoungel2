<?php $__env->startSection('title', 'Product list'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/owlcarousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/rating.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Product list')); ?></h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item"><?php echo e(trans('lang.Ecommerce')); ?></li>
    <li class="breadcrumb-item active"><?php echo e(trans('lang.Product list')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
            <a class="btn btn-outline-secondary-2x" href="/admin-panel/order/driver/<?php echo e($id); ?>"><?php echo e(trans('lang.Assign a driver')); ?></a>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th><?php echo e(trans('lang.Details')); ?></th>
                                    <th><?php echo e(trans('lang.Name')); ?></th>
                                    <th><?php echo e(trans('lang.Paid')); ?></th>
                                    <th><?php echo e(trans('lang.Doctor Paid Date')); ?></th>


                                    <th><?php echo e(trans('lang.Sale Date')); ?></th>
                   <th><?php echo e(trans('lang.Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($product->price===0): ?>
                                        <tr>
                                            <td><img style="width: 50px" src="/public/assets/images/product/<?php echo e($product->image); ?>" alt=""></td>
                                            <td>
                                                <h6 style="color:green"> <?php echo e($product->{'name_'.app()->getLocale()}); ?> </h6>
                                                <span style="color:green"><?php echo e(trans('lang.Gift')); ?></span>
                                            </td>
                                            <td><span style="color:green"><?php echo e(trans('lang.Gift')); ?></span></td>

                                            <td class="font-success"><?php echo e($product->order_details_paid); ?></td>
                                            <td class="font-success"><?php echo e($product->order_detail_created); ?></td>









                                            <td>
                                                <form action="<?php echo e(route('return.post',$product->order_details_id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php if($product->is_return===0): ?>
                                                        <select style="color:#1100FF" required id="is_return" name="is_return" class="form-control"  title="Select Manager...">

                                                            <option selected value="0"><?php echo e(trans('lang.Sales')); ?></option>
                                                            <option  value="1"><?php echo e(trans('lang.Return')); ?></option>

                                                        </select>
                                                    <?php elseif($product->is_return===1): ?>
                                                        <select style="color:#FF6800" required id="is_return" name="is_return" class="form-control"  title="Select Manager...">

                                                            <option  value="0"><?php echo e(trans('lang.Sales')); ?></option>
                                                            <option selected value="1"><?php echo e(trans('lang.Return')); ?></option>


                                                        </select>
                                                    <?php endif; ?>

                                                    <input  type="hidden"  name="order_details_id" id="order_details_id" value="<?php echo e($product->price - $product->paid); ?>" >

                                                   <?php if(is_null($product->order_details_paid)): ?>
                                                        <button type="submit" class="form-control btn btn-success btn-xs"  disabled data-original-title="btn btn-success btn-xs"><?php echo e(trans('lang.Change')); ?></button>

                                                    <?php else: ?>
                                                        <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs"><?php echo e(trans('lang.Change')); ?></button>

                                                    <?php endif; ?>
                                                </form>

                                            </td>


                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td><img style="width: 50px" src="/public/assets/images/product/<?php echo e($product->image); ?>" alt=""></td>
                                            <td>
                                                <h6> <?php echo e($product->{'name_'.app()->getLocale()}); ?> </h6>
                                                <span><?php echo e($product->price); ?> ₼</span>
                                            </td>
                                            <td><?php echo e($product->paid); ?></td>

                                            <td class="font-success"><?php echo e($product->order_details_paid); ?></td>
                                            <td class="font-success"><?php echo e($product->order_detail_created); ?></td>










                                            <td>
                                                <form action="<?php echo e(route('return.post',$product->order_details_id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php if($product->is_return===0): ?>
                                                        <select style="color:#1100FF" required id="is_return" name="is_return" class="form-control"  title="Select Manager...">

                                                            <option selected value="0"><?php echo e(trans('lang.Sales')); ?></option>
                                                            <option  value="1"><?php echo e(trans('lang.Return')); ?></option>
                                                        </select>
                                                    <?php elseif($product->is_return===1): ?>
                                                        <select style="color:#FF6800" required id="is_return" name="is_return" class="form-control"  title="Select Manager...">

                                                            <option  value="0"><?php echo e(trans('lang.Sales')); ?></option>
                                                            <option selected value="1"><?php echo e(trans('lang.Return')); ?></option>

                                                        </select>
                                                    <?php endif; ?>

                                                    <input  type="hidden"  name="order_details_id" id="order_details_id" value="<?php echo e($product->order_details_id); ?>" >

                                                    <?php if(!empty($product->order_details_paid)): ?>
                                                        <button type="submit" class="form-control btn btn-success btn-xs"  disabled data-original-title="btn btn-success btn-xs"><?php echo e(trans('lang.Change')); ?></button>

                                                    <?php else: ?>
                                                        <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs"><?php echo e(trans('lang.Change')); ?></button>

                                                    <?php endif; ?>
                                                </form>

                                            </td>


                                        </tr>

                                    <?php endif; ?>


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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/order/detail.blade.php ENDPATH**/ ?>