<?php $__env->startSection('title', 'Checkout'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Checkout')); ?></h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid checkout">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(trans('lang.Billing Details')); ?></h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="checkout-details">
                        <div class="order-box">
                            <div class="title-box">
                                <div class="checkbox-title">
                                    <h4><?php echo e(trans('lang.Product')); ?> </h4>
                                    <span><?php echo e(trans('lang.Total')); ?></span>
                                </div>
                            </div>
                            <ul class="show-cart qty">

                            </ul>


                            <ul class="sub-total total">

                                <li > <span><?php echo e(trans('lang.TOTAL')); ?> : &emsp;&emsp; </span> <span class="total-cart "> </span>₼</li>

                            <br>
                                <?php if(Auth::user()->role_id==1 or Auth::user()->role_id==3): ?>
                                    <form action="#">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="mb-3">

                                            <label for="doctorid"><?php echo e(trans('lang.Manager')); ?></label>
                                            <select required name="doctorid" id="doctorid" class="form-control" title="Select customer...">

                                                <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <option value="<?php echo e($manager->id); ?>"><?php echo e($manager->first_name . ' (' . $manager->phone . ')'); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                        </div>
                                        <input class="form-control" type="hidden"  name="user" id="user" value="<?php echo e(Auth::user()->id); ?>" >
                                        <input class="form-control" type="hidden"  name="role" id="role" value="2" >
                                        <input class="form-control" type="hidden"  name="pdf" id="pdf" value="<?php echo e(time()); ?>" >
                                        <input class="form-control" type="hidden"  name="location" id="location" value="Manager" >


                                        

                                        <div class="order-place">
                                            <a class="checkout_post btn btn-primary" ><?php echo e(trans('lang.Require a product')); ?>  </a>
                                        </div>
                                    </form>
                                <?php elseif(Auth::user()->role_id==2): ?>
                                    <form action="#">
                                        <?php echo e(csrf_field()); ?>


                                        <input class="form-control" type="hidden"  name="doctorid" id="doctorid" value="<?php echo e(Auth::user()->id); ?>" >

                                        <input class="form-control" type="hidden"  name="user" id="user" value="<?php echo e(Auth::user()->id); ?>" >
                                        <input class="form-control" type="hidden"  name="role" id="role" value="2" >
                                        <input class="form-control" type="hidden"  name="pdf" id="pdf" value="<?php echo e(time()); ?>" >
                                        <input class="form-control" type="hidden"  name="location" id="location" value="Manager" >


                                        

                                        <div class="order-place">
                                            <a class="checkout_post btn btn-primary" ><?php echo e(trans('lang.Require a product')); ?>  </a>
                                        </div>
                                    </form>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('manager.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/manager/manager/warehouse/checkout.blade.php ENDPATH**/ ?>