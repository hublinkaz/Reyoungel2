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

                            <form class="theme-form" action="<?php echo e(route('manager.report.product.post')); ?>" method="POST" enctype="multipart/form-data">
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
                                            <input type="hidden" id="manager_id" name="manager_id" value="<?php echo e(\Illuminate\Support\Facades\Auth::user()->id); ?>" >

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

<?php echo $__env->make('manager.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/manager/report/product.blade.php ENDPATH**/ ?>