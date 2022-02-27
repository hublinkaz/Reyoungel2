<?php $__env->startSection('title', 'Edit Profile'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Edit Profile')); ?></h3>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">

                <div class="col-xl-8">
                    <form class="card" action="<?php echo e(route('query.post')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="card-header">
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media">


                                        <div class="media-body">
                                            <h3 class="mb-1"><?php echo e($product->first_name); ?> <?php echo e($product->last_name); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(trans('lang.Status')); ?></label>
                                        <select required id="status" name="status" class="form-control"  title="<?php echo e(trans('lang.Select Status...')); ?>">
                                            <option  value="0"><?php echo e(trans('lang.Deactivate')); ?> </option>
                                            <option  value="1"><?php echo e(trans('lang.Active')); ?> </option>
                                            <option  value="2"><?php echo e(trans('lang.Cancel')); ?> </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(trans('lang.Product')); ?></label>
                                        <input class="form-control" type="text" placeholder="First Name" name="product_id" disabled id="product_id" value="<?php echo e($product->{'name_'.app()->getLocale()}); ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(trans('lang.Qty')); ?></label>
                                        <input class="form-control" type="number" placeholder="qty" name="qty" id="qty" value="<?php echo e($product->qty); ?>">
                                    </div>
                                </div>
                                    <input class="" type="hidden" name="id" value="<?php echo e($product->id); ?>">
                                    <input class="" type="hidden" name="product_id" value="<?php echo e($product->product_id); ?>">
                                    <input class="" type="hidden" name="manager_id" value="<?php echo e($product->manager_id); ?>">
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit"><?php echo e(trans('lang.Submit')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/manager/update_query.blade.php ENDPATH**/ ?>