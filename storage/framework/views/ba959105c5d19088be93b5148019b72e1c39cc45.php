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
                    <form class="card" action="<?php echo e(route('account.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="card-header">
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media">
                                        <img class="img-70 rounded-circle" alt="image" src="/public/assets/images/avtar/<?php echo e($account->image); ?>">

                                        <div class="media-body">
                                            <h3 class="mb-1"><?php echo e($account->first_name); ?> <?php echo e($account->last_name); ?></h3>
                                            <p><?php echo e(\App\Models\Roles::where('id',$account->role_id)->first()->name); ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.image')); ?></label>
                                            <input id="image" name="image" class="input-file" type="file" accept="image/*">
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
                                        <label class="form-label"><?php echo e(trans('lang.Profile Status')); ?></label>
                                        <select required id="last_manager_id" name="is_active" class="form-control"  title="Select Manager...">

                                                <?php if($account->is_active==0): ?>
                                                    <option selected value="0"><?php echo e(trans('lang.Deactivate')); ?> </option>
                                                    <option  value="1"><?php echo e(trans('lang.Active')); ?> </option>
                                                    <option value="2"><?php echo e(trans('lang.Banned')); ?>  </option>
                                                <?php elseif($account->is_active==1): ?>
                                                    <option  value="0"><?php echo e(trans('lang.Deactivate')); ?> </option>
                                                    <option selected value="1"><?php echo e(trans('lang.Active')); ?> </option>
                                                    <option value="2"> <?php echo e(trans('lang.Banned')); ?> </option>
                                                <?php elseif($account->is_active==2): ?>
                                                    <option  value="0"><?php echo e(trans('lang.Deactivate')); ?> </option>
                                                    <option  value="1"><?php echo e(trans('lang.Active')); ?> </option>
                                                    <option selected value="2"><?php echo e(trans('lang.Banned')); ?> </option>
                                                <?php endif; ?>


                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(trans('lang.First Name')); ?></label>
                                        <input class="form-control" type="text" placeholder="<?php echo e(trans('lang.First Name')); ?>" name="first_name" id="first_name" value="<?php echo e($account->first_name); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(trans('lang.Last Name')); ?></label>
                                        <input class="form-control" type="text" placeholder="<?php echo e(trans('lang.Last Name')); ?>" name="last_name" id="last_name" value="<?php echo e($account->last_name); ?>">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(trans('lang.Coordinate')); ?> X</label>
                                        <input class="form-control" type="text" placeholder="<?php echo e(trans('lang.Coordinate')); ?> X" name="map_x" id="map_x" value="<?php echo e($account->map_x); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(trans('lang.Coordinate')); ?> Y</label>
                                        <input class="form-control" type="text" placeholder="<?php echo e(trans('lang.Coordinate')); ?> Y" name="map_y" id="map_y" value="<?php echo e($account->map_y); ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="col-form-label"><?php echo e(trans('lang.Card identity')); ?></label>
                                        <input class="form-control" type="text" name="card_number" value="<?php echo e($account->card_number); ?>" placeholder="<?php echo e(trans('lang.Card identity')); ?>" id="card_number">
                                    </div>
                                </div>

                                <?php if(\Illuminate\Support\Facades\Auth::user()->role_id==1): ?>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(trans('lang.Email address')); ?></label>
                                        <input class="form-control" type="email" placeholder="<?php echo e(trans('lang.Email address')); ?>" disabled name="email" value="<?php echo e($account->email); ?>">
                                    </div>
                                </div>
                                <?php else: ?>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"><?php echo e(trans('lang.Email address')); ?></label>
                                            <input class="form-control" type="email" placeholder="<?php echo e(trans('lang.Email address')); ?>" disabled name="email" value="<?php echo e($account->email); ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(trans('lang.Phone number')); ?> </label>
                                        <input class="form-control" type="text" placeholder="<?php echo e(trans('lang.Phone number')); ?> " name="phone" value="<?php echo e($account->phone); ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Telegram iD </label>
                                        <input class="form-control" type="text" placeholder="Telegram iD" name="telegram" value="<?php echo e($account->telegram_user_id); ?>">
                                    </div>
                                </div>
                                <?php if($account->role_id ==5): ?>
                                    <input class="" type="hidden" name="id" value="<?php echo e($account->user_id); ?>">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"><?php echo e(trans('lang.Address')); ?></label>
                                            <input class="form-control" type="text" placeholder="<?php echo e(trans('lang.Address')); ?>" name="location" value="<?php echo e($account->location); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"><?php echo e(trans('lang.Work Address')); ?></label>
                                            <input class="form-control" type="text" placeholder="<?php echo e(trans('lang.Work Address')); ?>" name="workplace" value="<?php echo e($account->workplace); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"><?php echo e(trans('lang.Managers')); ?> </label>
                                            <select required id="last_manager_id" name="last_manager_id" class="form-control"  title="Select Manager...">
                                                <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($manager->user_id==$account->last_manager_id): ?>
                                                        <option selected value="<?php echo e($manager->user_id); ?>"><?php echo e($manager->first_name); ?>  <?php echo e($manager->last_name); ?> </option>
                                                    <?php else: ?>
                                                      <option value="<?php echo e($manager->user_id); ?>"><?php echo e($manager->first_name); ?>  <?php echo e($manager->last_name); ?> </option>
                                                    <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                <?php elseif($account->role_id ==4): ?>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"><?php echo e(trans('lang.Car Number')); ?></label>
                                            <input class="form-control" type="text" placeholder="<?php echo e(trans('lang.Car Number')); ?>" name="car_number" value="<?php echo e($account->car_number); ?>">
                                        </div>
                                    </div>
                                    <input class="" type="hidden" name="id" value="<?php echo e($account->id); ?>">

                                <?php elseif($account->role_id ==2): ?>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"><?php echo e(trans('lang.Percentage')); ?></label>
                                            <input class="form-control" type="text" placeholder="<?php echo e(trans('lang.Percentage')); ?>" name="percentage_value" value="<?php echo e($account->percentage_value); ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <input class="" type="hidden" name="id" value="<?php echo e($account->id); ?>">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label"><?php echo e(trans('lang.Desc')); ?></label>
                                    <textarea class="form-control" type="text" name="description" placeholder="<?php echo e(trans('lang.Desc')); ?>" id="description"><?php echo e($account->description); ?></textarea>
                                </div>
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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/account/edit-profile.blade.php ENDPATH**/ ?>