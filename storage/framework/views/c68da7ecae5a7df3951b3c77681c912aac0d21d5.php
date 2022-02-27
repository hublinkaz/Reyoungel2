<?php $__env->startSection('title', 'Checkout'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Checkout')); ?></h3>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="container-fluid checkout">
        <div class="card">



            <div class="card-body">
                <div class="row">

                    <div class="checkout-details">
                        <div class="order-box">
                            <div class="title-box">
                                <div class="checkbox-title">
                                    <h4><?php echo e(trans('lang.Product')); ?></h4>
                                    <span><?php echo e(trans('lang.Total')); ?></span>
                                </div>
                            </div>
                            <ul class="show-cart qty">

                            </ul>


                            <ul class="sub-total total">
                                <li > <span><?php echo e(trans('lang.Total')); ?> : &emsp;&emsp; </span> <span class="total-cart "> </span>₼</li>

                            </ul>

                            <br>
                            <form action="#">
                                <?php echo e(csrf_field()); ?>

                                <div class="mb-3">

                                    <label for="doctorid"><?php echo e(trans('lang.Doctor')); ?></label>
                                    <select required name="doctorid" id="doctorid" class="form-control" title="Select customer...">

                                        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                                  <option value="<?php echo e($doctor->id); ?>"><?php echo e($doctor->first_name . ' ' . $doctor->last_name . ''. ' (' . $doctor->phone . ')'); ?></option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                                <select required name="order_type" id="order_type" class="form-control" title="Select customer...">
                                    <option value="1">Nəğd Alış</option>
                                    <option value="2">Depozit</option>

                                </select>

                                <input class="form-control" type="hidden"  name="user" id="user" value="<?php echo e(\Illuminate\Support\Facades\Auth::user()->id); ?>" >
                                <input class="form-control" type="hidden"  name="user_role" id="user_role" value="<?php echo e(Auth::user()->role_id); ?>" >
                                <input class="form-control" type="hidden"  name="role" id="role" value="5" >
                                <input class="form-control" type="hidden"  name="order_type" id="order_type" value="1" >
                                <input class="form-control" type="hidden"  name="pdf" id="pdf" value="<?php echo e(time()); ?>" >
                                <label for="location"></label><textarea name="location" required id="location" placeholder="<?php echo e(trans('lang.Note')); ?>" class="form-control btn-square" ></textarea>

                                <div class="order-place">
                                    <a class="checkout_post btn btn-primary" ><?php echo e(trans('lang.Checkout')); ?> </a>
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

<?php echo $__env->make('manager.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/manager/checkout/checkout.blade.php ENDPATH**/ ?>