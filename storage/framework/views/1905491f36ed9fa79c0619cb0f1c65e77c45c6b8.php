<?php $__env->startSection('title', 'Edit Profile'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Driver Assignment')); ?></h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">

                <div class="col-xl-8">
                    <form class="card" action="<?php echo e(route('order.driver.post')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"><?php echo e(trans('lang.Drivers')); ?> </label>
                                            <select required id="driver_id" name="driver_id" class="form-control"  title="Select Manager...">
                                                <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($driver->user_id==$order->driver_id): ?>
                                                        <option selected value="<?php echo e($driver->user_id); ?>"><?php echo e($driver->first_name); ?>  <?php echo e($driver->last_name); ?> </option>
                                                    <?php else: ?>
                                                        <option value="<?php echo e($driver->user_id); ?>"><?php echo e($driver->first_name); ?>  <?php echo e($driver->last_name); ?> </option>
                                                    <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input class="" type="hidden" name="id" value="<?php echo e($order->id); ?>">
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit"><?php echo e(trans('lang.Approval')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/order/driver/create.blade.php ENDPATH**/ ?>