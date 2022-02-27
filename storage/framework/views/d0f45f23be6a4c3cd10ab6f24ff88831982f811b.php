<?php $__env->startSection('title', 'Default Forms'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3>Default Forms</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="<?php echo e(route('product.update',$product->id)); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1"><?php echo e(trans('lang.Name')); ?> AZ</label>
                                        <input class="form-control"  type="text" value="<?php echo e($product->name_az); ?>" name="name_az" placeholder="Enter Name AZ">
                                    </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1"><?php echo e(trans('lang.Name')); ?> EN</label>
                                    <input class="form-control"  type="text" value="<?php echo e($product->name_en); ?>" name="name_en" placeholder="Enter Name EN">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1"><?php echo e(trans('lang.Name')); ?> RU</label>
                                    <input class="form-control"  type="text" value="<?php echo e($product->name_ru); ?>" name="name_ru" placeholder="Enter Name RU">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1"><?php echo e(trans('lang.Name')); ?> TR</label>
                                    <input class="form-control"  type="text" value="<?php echo e($product->name_tr); ?>" name="name_tr" placeholder="Enter Name TR">
                                </div>


                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1"><?php echo e(trans('lang.Qty')); ?></label>
                                        <input class="form-control" type="text" name="qty" value="<?php echo e($product->qty); ?>" placeholder="Enter Qty"><small class="form-text text-muted" id="emailHelp"><?php echo e(trans('lang.We well never share your email with anyone else.')); ?></small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1"><?php echo e(trans('lang.Price')); ?></label>
                                        <input class="form-control" type="text" name="price" value="<?php echo e($product->price); ?>" placeholder="Enter Price"><small class="form-text text-muted" id="emailHelp"><?php echo e(trans('lang.We well never share your email with anyone else.')); ?></small>
                                    </div>


                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.Desc')); ?> AZ</label>
                                        <textarea class="form-control btn-square" id="detail_az"  name="detail_az"><?php echo e($product->detail_az); ?></textarea>
                                    </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.Desc')); ?> EN</label>
                                    <textarea class="form-control btn-square" id="detail_en"  name="detail_en"><?php echo e($product->detail_en); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.Desc')); ?> RU</label>
                                    <textarea class="form-control btn-square" id="detail_ru"  name="detail_ru"><?php echo e($product->detail_ru); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.Desc')); ?> TR</label>
                                    <textarea class="form-control btn-square" id="detail_tr"  name="detail_tr"><?php echo e($product->detail_tr); ?></textarea>
                                </div>


                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputPassword1"><?php echo e(trans('lang.image')); ?></label>
                                        <input id="image" name="image" class="input-file" type="file" value="<?php echo e($product->image); ?>" accept="image/*">
                                    </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo e(trans('lang.Status')); ?></label>
                                        <select required id="status" name="status" class="form-control"  title="Select Status...">

                                            <?php if($product->status==0): ?>
                                                <option selected value="0"><?php echo e(trans('lang.Deactivate')); ?> </option>
                                                <option  value="1"><?php echo e(trans('lang.Active')); ?> </option>


                                            <?php elseif($product->status==1): ?>
                                                <option  value="0"><?php echo e(trans('lang.Deactivate')); ?> </option>
                                                <option selected value="1"><?php echo e(trans('lang.Active')); ?> </option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/product/edit.blade.php ENDPATH**/ ?>