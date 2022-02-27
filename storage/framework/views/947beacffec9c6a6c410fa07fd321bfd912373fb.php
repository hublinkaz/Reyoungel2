 
<?php $__env->startSection('title', 'Sign-up'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo" href="<?php echo e(route('index')); ?>"><img class="img-fluid for-light" src="<?php echo e(asset('assets/images/logo/login.png')); ?>" alt="looginpage"><img class="img-fluid for-dark" src="<?php echo e(asset('assets/images/logo/logo_dark.png')); ?>" alt="looginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form" action="<?php echo e(route('doctor.registration')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <h4><?php echo e(trans('lang.Create your account')); ?></h4>
                                <p><?php echo e(trans('lang.Enter your personal details to create account')); ?></p>
                                <div class="form-group">
                                    <label class="col-form-label pt-0"><?php echo e(trans('lang.Your Name')); ?></label>
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
                                    <label class="col-form-label"><?php echo e(trans('lang.Phone number')); ?></label>
                                    <input class="form-control" type="text" id="phone" name="phone" required="" placeholder="<?php echo e(trans('lang.Phone number')); ?>">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Work Address')); ?></label>
                                    <input class="form-control" type="text" required="" name="location" placeholder="<?php echo e(trans('lang.Work Address')); ?>" id="location">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Work location Name')); ?></label>
                                    <input class="form-control" type="text" required="" name="workplace" placeholder="<?php echo e(trans('lang.Work location Name')); ?>" id="workplace">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Email Address')); ?></label>
                                    <input class="form-control" type="email" required="" name="email" placeholder="<?php echo e(trans('lang.Email Address')); ?>" id="email_address">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Card identity')); ?></label>
                                    <input class="form-control" type="card_number"  name="card_number" placeholder="<?php echo e(trans('lang.Card identity')); ?>" id="card_number">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Birth Day')); ?></label>
                                    <input class="form-control" type="date" id="birth_date" name="birth_date" required="" placeholder="<?php echo e(trans('lang.Birth Day')); ?>">

                                </div>

                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Password')); ?></label>
                                    <input class="form-control" type="password" required="" name="password" placeholder="<?php echo e(trans('lang.Password')); ?>" id="password">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Confirim Password')); ?></label>
                                    <input class="form-control" type="password" required="" name="password_confirmation" placeholder="<?php echo e(trans('lang.Confirim Password')); ?>" id="password_confirmation">
                                </div>
                                <input class="form-control" type="hidden"  name="role_id" id="role_id" value="5" >
                                <input class="form-control" type="hidden"  name="manager_id" id="last_manager_id" value="3" >
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox">
                                        <label class="text-muted" for="checkbox1"><?php echo e(trans('lang.Agree with')); ?><a class="ms-2" href="#"><?php echo e(trans('lang.Privacy Policy')); ?></a></label>
                                    </div>


                                    <button class="btn btn-primary btn-block" type="submit"><?php echo e(trans('lang.Create Account')); ?></button>
                                </div>


                                <p class="mt-4 mb-0"><?php echo e(trans('lang.Already have an account?')); ?><a class="ms-2" href="<?php echo e(route('login')); ?>"><?php echo e(trans('lang.Sign in')); ?></a></p>
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

<?php echo $__env->make('layouts.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/auth/signup.blade.php ENDPATH**/ ?>