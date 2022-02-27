<?php $__env->startSection('title', 'Default Forms'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Default Forms')); ?></h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item"><?php echo e(trans('lang.Form Layout')); ?></li>
    <li class="breadcrumb-item active"><?php echo e(trans('lang.Default Forms')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="<?php echo e(route('blog.store')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1"><?php echo e(trans('lang.Name')); ?> AZ</label>
                                    <input class="form-control"  type="text" name="name_az" placeholder="Enter Name AZ">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1"><?php echo e(trans('lang.Name')); ?> EN</label>
                                    <input class="form-control"  type="text" name="name_en" placeholder="Enter Name EN">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1"><?php echo e(trans('lang.Name')); ?> RU</label>
                                    <input class="form-control"  type="text" name="name_ru" placeholder="Enter Name RU">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1"><?php echo e(trans('lang.Name')); ?> TR</label>
                                    <input class="form-control"  type="text" name="name_tr" placeholder="Enter Name TR">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.Desc')); ?> AZ</label>
                                    <textarea class="form-control btn-square" id="detail_az" name="detail_az"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.Desc')); ?> EN</label>
                                    <textarea class="form-control btn-square" id="detail_en" name="detail_en"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.Desc')); ?> RU</label>
                                    <textarea class="form-control btn-square" id="detail_ru" name="detail_ru"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.Desc')); ?> TR</label>
                                    <textarea class="form-control btn-square" id="detail_tr" name="detail_tr"></textarea>
                                </div>


                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.image')); ?></label>
                                    <input id="image" name="image" class="input-file" type="file" accept="image/*">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><?php echo e(trans('lang.Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                        <script>
                            tinymce.init({
                                selector: '#detail_az',
                            });
                            tinymce.init({
                                selector: '#detail_en',
                            });
                            tinymce.init({
                                selector: '#detail_ru',
                            });
                            tinymce.init({
                                selector: '#detail_tr',
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/blog/create.blade.php ENDPATH**/ ?>