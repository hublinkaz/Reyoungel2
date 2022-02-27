<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5"><img class="bg-img-cover bg-center" src="<?php echo e(asset('assets/images/login/3.jpg')); ?>" alt="looginpage"></div>
            <div class="col-xl-7 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo text-start" href="/"><img class="img-fluid for-light" src="<?php echo e(asset('assets/images/logo/login.png')); ?>" alt="looginpage"><img class="img-fluid for-dark" src="<?php echo e(asset('assets/images/logo/logo_dark.png')); ?>" alt="looginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="<?php echo e(route('signin.custom')); ?>">
                      <?php echo csrf_field(); ?>
                                <h4><?php echo e(trans('lang.Sign in to account')); ?></h4>
                                <p><?php echo e(trans('lang.Enter your email & password to login')); ?></p>
                       <div class= "form-group">
                            <label class="col-form-label"><?php echo e(trans('lang.Email Address')); ?></label>
                            <input class="form-control" type="email" required autofocus name="email" placeholder="Email" id="email">
                            <?php if($errors->has('email')): ?>
                                <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><?php echo e(trans('lang.Password')); ?></label>
                            <input class="form-control" type="password"  required="" name="password" placeholder="Password" id="password">
                            <?php if($errors->has('password')): ?>
                                <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-0">




                            <button class="btn btn-primary btn-block" type="submit"><?php echo e(trans('lang.Sign in')); ?></button>
                        </div>
                        <h6 class="text-muted mt-4 or"><?php echo e(trans('lang.Or Sign in with')); ?></h6>

                        <p class="mt-4 mb-0"><?php echo e(trans('lang.Dont have account?')); ?><a style="color: red; font-weight: 900; font-size: 18px"  class="ms-2" href="<?php echo e(route('register')); ?>"><?php echo e(trans('lang.Create Account')); ?></a></p>
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

<?php echo $__env->make('layouts.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/auth/signin.blade.php ENDPATH**/ ?>