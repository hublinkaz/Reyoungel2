<?php $__env->startSection('title', 'Reset-password'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        <div>
                            <div><a class="logo" href="<?php echo e(route('index')); ?>"><img class="img-fluid for-light" src="<?php echo e(asset('assets/images/logo/login.png')); ?>" alt="looginpage"><img class="img-fluid for-dark" src="<?php echo e(asset('assets/images/logo/logo_dark.png')); ?>" alt="looginpage"></a></div>
                            <div class="login-main">
                            <form class="theme-form" action="<?php echo e(route('password.reset')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                    <h4><?php echo e(trans('lang.Create Your Password')); ?> </h4>
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('lang.New Password')); ?></label>
                                        <input class="form-control" type="password" name="password" required placeholder="*********">
                                        <div class="show-hide"><span class="show"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('lang.Retype Password')); ?></label>
                                        <input class="form-control" type="password" name="password_confirmation" required placeholder="*********">
                                        <input type="hidden" name="id" value="<?php echo e($account->id); ?>">
                                    </div>
                                    <div class="form-group mb-0">




                                        <button class="btn btn-primary btn-block" type="submit"><?php echo e(trans('lang.Submit')); ?> </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/account/reset_password.blade.php ENDPATH**/ ?>