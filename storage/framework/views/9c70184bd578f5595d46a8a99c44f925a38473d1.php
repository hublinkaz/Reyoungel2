<?php $__env->startSection('title', 'HTML 5 Data Export'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatable-extension.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

<h3><?php echo e(trans('lang.Doctors')); ?></h3>
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
									<th><?php echo e(trans('lang.No')); ?></th>
									<th><?php echo e(trans('lang.Product Name')); ?></th>
									<th><?php echo e(trans('lang.Price')); ?></th>
									<th><?php echo e(trans('lang.All Products')); ?></th>
									<th><?php echo e(trans('lang.Price')); ?></th>
									<th><?php echo e(trans('lang.Warehouse')); ?></th>
									<th><?php echo e(trans('lang.Price')); ?></th>
                                    <th><?php echo e(trans('lang.Doctor')); ?></th>
                                    <th><?php echo e(trans('lang.Price')); ?></th>
									<th><?php echo e(trans('lang.Manager')); ?></th>
									<th><?php echo e(trans('lang.Price')); ?></th>

								</tr>
							</thead>
							<tbody>
<?php
    $count=1;
?>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>

                                        <td><?php echo e($count++); ?> </td>
                                        <td><?php echo e($product->name_az); ?></td>
                                        <td><?php echo e($product->price); ?> Azn</td>
                                        <td><?php echo e($product->qty); ?></td>
                                        <td><?php echo e($product->total_price); ?> Azn</td>
                                        <td><?php echo e($product->admin_qty); ?></td>
                                        <td><?php echo e($product->admin_price); ?> Azn</td>
                                        <td><?php echo e($product->doctor_qty); ?></td>
                                        <td><?php echo e($product->doctor_price); ?> Azn</td>
                                        <td><?php echo e($product->manager_qty); ?></td>
                                        <td><?php echo e($product->manager_price); ?> Azn</td>
                                    </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td> </td>
                            <td>                                   <?php echo e(trans('lang.Total')); ?>

</td>
                            <td></td>
                            <td><?php echo e($total[0]->qty); ?></td>
                            <td><?php echo e($total[0]->total_price); ?> Azn</td>
                            <td><?php echo e($total[0]->admin_qty); ?></td>
                            <td><?php echo e($total[0]->admin_price); ?> Azn</td>
                            <td><?php echo e($total[0]->doctor_qty); ?></td>
                            <td><?php echo e($total[0]->doctor_price); ?> Azn</td>
                            <td><?php echo e($total[0]->manager_qty); ?></td>
                            <td><?php echo e($total[0]->manager_price); ?> Azn</td>
							</tbody>
							<tfoot>
								<tr>
                                    <th><?php echo e(trans('lang.No')); ?></th>
                                    <th><?php echo e(trans('lang.Product Name')); ?></th>
                                    <th><?php echo e(trans('lang.Price')); ?></th>
                                    <th><?php echo e(trans('lang.All Products')); ?></th>
                                    <th><?php echo e(trans('lang.Price')); ?></th>
                                    <th><?php echo e(trans('lang.Warehouse')); ?></th>
                                    <th><?php echo e(trans('lang.Price')); ?></th>
                                    <th><?php echo e(trans('lang.Doctor')); ?></th>
                                    <th><?php echo e(trans('lang.Price')); ?></th>
                                    <th><?php echo e(trans('lang.Manager')); ?></th>
                                    <th><?php echo e(trans('lang.Price')); ?></th>

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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/report/warehouse.blade.php ENDPATH**/ ?>