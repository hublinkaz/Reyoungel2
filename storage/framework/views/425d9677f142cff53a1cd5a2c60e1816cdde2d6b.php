<?php $__env->startSection('title', 'Default Forms'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="<?php echo e(route('create.driver.update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <h4><?php echo e(trans('lang.Create your account')); ?></h4>
                                <p><?php echo e(trans('lang.Enter your personal details to create account')); ?></p>
                                <div class="form-group">
                                    <label class="col-form-label pt-0"><?php echo e(trans('lang.Name')); ?></label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input class="form-control" type="text" id="first_name" name="first_name" required="" placeholder="<?php echo e(trans('lang.First Name')); ?>">
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="text" id="last_name" name="last_name" required="" placeholder="<?php echo e(trans('lang.Last Name')); ?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Email Address')); ?></label>
                                    <input class="form-control" type="email" required="" name="email" placeholder="<?php echo e(trans('lang.Email')); ?>" id="email_address">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Car number')); ?></label>
                                    <input class="form-control" type="text" required="" name="car_number" placeholder="<?php echo e(trans('lang.Car Number')); ?>" id="car_number">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Card identity')); ?></label>
                                    <input class="form-control" type="text" name="card_number" placeholder="<?php echo e(trans('lang.Card identity')); ?>" id="card_number">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Birth Day')); ?></label>
                                    <input class="form-control" type="date" id="birth_date" name="birth_date" required="" placeholder="<?php echo e(trans('lang.Phone number')); ?>">

                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Phone number')); ?></label>
                                    <input class="form-control" type="text" id="phone" name="phone" required="" placeholder="<?php echo e(trans('lang.Phone number')); ?>">

                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Password')); ?></label>
                                    <input class="form-control" type="password" required="" name="password" placeholder="<?php echo e(trans('lang.Password')); ?>" id="password">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Confirim Password')); ?></label>
                                    <input class="form-control" type="password" required="" name="password_confirmation" placeholder="<?php echo e(trans('lang.Password')); ?>" id="password_confirmation">
                                </div>
                                <input class="form-control" type="hidden"  name="role_id" id="role_id" value="4" >
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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/driver/create.blade.php ENDPATH**/ ?>