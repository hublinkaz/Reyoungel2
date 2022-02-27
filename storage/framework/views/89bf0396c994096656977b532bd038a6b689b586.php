<?php $__env->startSection('title', 'Default Forms'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Select Date')); ?></h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="<?php echo e(route('report.doctor.post')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <div class="form-group">
                                    <div class="row g-2">
                                        <div class="col-6">
                                    <label class="col-form-label"><?php echo e(trans('lang.Beginning')); ?></label>
                                    <input class="form-control" type="date" id="date_start" name="date_start" required="" placeholder="<?php echo e(trans('lang.Beginning Date')); ?>">
                                        </div>
                                        <div class="col-6">
                                            <label class="col-form-label"><?php echo e(trans('lang.Finish Date')); ?></label>
                                            <input class="form-control" type="date" id="date_end" name="date_end" required="" placeholder="<?php echo e(trans('lang.Finish Date')); ?>">
                                        </div>
                                    </div>
                                </div>

                                    <div class="form-group">
                                        <div class="row g-2">
                                            <div class="col-6">
                                        <label><?php echo e(trans('lang.Doctors')); ?> *</label>
                                        <select required id="manager_id" name="manager_id" class="form-control"  title="Select Manager...">
                                            <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($manager->id); ?>"><?php echo e($manager->manager_first_name); ?> <?php echo e($manager->manager_last_name); ?> | <?php echo e($manager->first_name); ?> <?php echo e($manager->last_name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                            </div>
                                        </div>
                                    </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><?php echo e(trans('lang.Submit')); ?></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/admin/report/doctor.blade.php ENDPATH**/ ?>