<?php $__env->startSection('title', 'Default Forms'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Add Doctor')); ?></h3>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="<?php echo e(route('create.doctor.update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

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
                                    <label class="col-form-label"><?php echo e(trans('lang.Phone number')); ?></label>
                                    <input class="form-control" type="text" id="phone" name="phone" required="" placeholder="<?php echo e(trans('lang.Phone number')); ?>">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Work Address')); ?></label>
                                    <input class="form-control" type="text" required="" name="workplace" placeholder="<?php echo e(trans('lang.Work Address')); ?>" id="İş Yeri">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Workplace Name')); ?></label>
                                    <input class="form-control" type="text" required="" name="location" placeholder="<?php echo e(trans('lang.Workplace Name')); ?>" id="Ünvan">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Card identity')); ?></label>
                                    <input class="form-control" type="text" name="card_number" placeholder="<?php echo e(trans('lang.Card identity')); ?>" id="card_number">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Birth Day')); ?></label>
                                    <input class="form-control" type="date" id="birth_date" name="birth_date" required="" placeholder="<?php echo e(trans('lang.Birth Day')); ?>">

                                </div>

                                <div class="form-group">
                                    <label><?php echo e(trans('lang.doctor-appointed manager')); ?> *</label>
                                    <select required id="last_manager_id" name="last_manager_id" class="form-control"  title="Select Manager...">
                                        <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($manager->id); ?>"><?php echo e($manager->first_name); ?> <?php echo e($manager->last_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Password')); ?></label>
                                    <input class="form-control" type="password" required="" name="password" placeholder="<?php echo e(trans('lang.Password')); ?>" id="password">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo e(trans('lang.Confirim Password')); ?></label>
                                    <input class="form-control" type="password" required="" name="password_confirmation" placeholder="<?php echo e(trans('lang.Password')); ?>" id="password_confirmation">
                                </div>
                                <input class="form-control" type="hidden"  name="role_id" id="role_id" value="5" >
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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/doctor/create.blade.php ENDPATH**/ ?>