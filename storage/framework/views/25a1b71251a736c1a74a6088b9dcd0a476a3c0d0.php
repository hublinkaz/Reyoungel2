<?php $__env->startSection('title', 'Product list'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/owlcarousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/rating.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3><?php echo e(trans('lang.Doctors')); ?></h3>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th><?php echo e(trans('lang.Details')); ?></th>
                                    <th><?php echo e(trans('lang.Details')); ?></th>

                                    <th><?php echo e(trans('lang.Stock')); ?></th>

                   <th><?php echo e(trans('lang.Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><img style="width: 50px" src="/public/assets/images/doctors/<?php echo e(json_decode($doctor->images)[0]); ?>" alt=""></td>
                                    <td>
                                        <h6> <?php echo e($doctor->name); ?> </h6>
                                        <span><?php echo e($doctor->phone); ?></span>
                                    </td>

                                    <td class="font-success"><?php echo e($doctor->location); ?></td>


                                    <td>
                                        <form action="<?php echo e(route('front.doctors.delete',$doctor->id)); ?>" method="POST">


                                            <a class="btn btn-success "  data-original-title="btn btn-danger btn-xs" href="<?php echo e(route('front.doctors.edit',$doctor->id)); ?>"><?php echo e(trans('lang.Edit')); ?></a>

                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('delete'); ?>

                                            <button type="submit" class="btn btn-danger btn-xs"  data-original-title="btn btn-danger btn-xs"><?php echo e(trans('lang.Delete')); ?></button>
                                        </form>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/rating/jquery.barrating.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/rating/rating-script.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/owlcarousel/owl.carousel.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/ecommerce.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/product-list-custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/admin/settings/doctors/index.blade.php ENDPATH**/ ?>