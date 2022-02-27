<?php $__env->startSection('title', 'HTML 5 Data Export'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatable-extension.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

    <h3><?php echo e(trans('lang.Total')); ?></h3>
    <h3><?php echo e($total); ?> Azn</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item"><?php echo e(trans('lang.Home')); ?></li>
    <li class="breadcrumb-item active"><?php echo e(trans('lang.Products')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div class="dt-ext table-responsive">
                            <table class="display" id="export-button">

                                <thead>
                                <tr>
                                    <th><?php echo e(trans('lang.Image')); ?></th>
                                    <th><?php echo e(trans('lang.Name')); ?></th>
                                    <th><?php echo e(trans('lang.Price')); ?></th>
                                    <th><?php echo e(trans('lang.Qty')); ?></th>
                                    <th><?php echo e(trans('lang.Discount')); ?></th>
                                    <th><?php echo e(trans('lang.Date')); ?></th>
                                    <th><?php echo e(trans('lang.Action')); ?></th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><img style="width: 50px" src="/public/assets/images/product/<?php echo e($product->image); ?>" alt="">
                                        </td>
                                        <td><a ><?php echo e($product->{'name_'.app()->getLocale()}); ?></a></td>
                                        <td><?php echo e($product->price); ?></td>
                                        <td><?php echo e($product->qty); ?></td>
                                        <td><?php echo e($product->discount); ?></td>
                                        <td><?php echo e($product->created_at); ?></td>
                                        <td>
                                            <form action="<?php echo e(route('warehouse.return',$product->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>

                                                <input  type="number"  name="qty" id="qty" value="0" >
                                                <input  type="hidden"  name="product_id" id="product_id" value="<?php echo e($product->id); ?>" >
                                                <input  type="hidden"  name="manager_id" id="manager_id" value="<?php echo e(\Illuminate\Support\Facades\Auth::user()->id); ?>" >
                                                <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs">Qaytar</button>

                                            </form>


                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th><?php echo e(trans('lang.Image')); ?></th>
                                    <th><?php echo e(trans('lang.Name')); ?></th>
                                    <th><?php echo e(trans('lang.Price')); ?></th>
                                    <th><?php echo e(trans('lang.Qty')); ?></th>
                                    <th><?php echo e(trans('lang.Discount')); ?></th>
                                    <th><?php echo e(trans('lang.Date')); ?></th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('manager.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/manager/manager/warehouse.blade.php ENDPATH**/ ?>