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
									<th><?php echo e(trans('lang.Id')); ?></th>
									<th><?php echo e(trans('lang.Name')); ?></th>
									<th><?php echo e(trans('lang.Total buy count')); ?></th>
									<th><?php echo e(trans('lang.Total buy price')); ?></th>
									<th><?php echo e(trans('lang.Total take count')); ?></th>
									<th><?php echo e(trans('lang.Total take price')); ?></th>
									<th><?php echo e(trans('lang.ŞİRKƏTƏ TOPLAM ÖDƏNİŞ')); ?></th>
									<th><?php echo e(trans('lang.TOPLAM ALINAN FAİZLƏR')); ?></th>
									<th><?php echo e(trans('lang.Date')); ?></th>

								</tr>
							</thead>
							<tbody>

                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>

                                        <td><?php echo e($product->id); ?> </td>
                                        <td><?php echo e($product->name_az); ?></td>
                                        <td><?php echo e($product->order_qty); ?></td>
                                        <td><?php echo e(round($product->order_price,1)); ?></td>
                                        <td><?php echo e($product->total_order_qty); ?></td>
                                        <td><?php echo e(round($product->total_amount,1)); ?></td>
                                        <td><?php echo e(round($product->company_price,1)); ?></td>
                                        <td><?php echo e(round($product->manager_price,1)); ?></td>
                                        <td><?php echo e($product->created); ?></td>


                                    </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <td></td>
                                <td>Toplam :</td>
                                <td><?php echo e($total_paid[0]->qty); ?></td>
                                <td><?php echo e(round($total_paid[0]->paid,1)); ?> Azn</td>
                                <td><?php echo e($total_paid[0]->qty + $total_nopaid[0]->qty); ?></td>
                                <td><?php echo e(round($total_paid[0]->amount + $total_nopaid[0]->amount,1)); ?>  Azn</td>
                                <td><?php echo e(round($total_paid[0]->paid-($total_paid[0]->paid*$total_paid[0]->percentage_value)/100,1)); ?>  Azn</td>
                                <td><?php echo e(round(($total_paid[0]->paid*$total_paid[0]->percentage_value)/100,1)); ?>  Azn</td>
                                <td></td>


                            </tr>
							</tbody>
							<tfoot>
								<tr>
                                    <th><?php echo e(trans('lang.Id')); ?></th>
                                    <th><?php echo e(trans('lang.Name')); ?></th>
                                    <th><?php echo e(trans('lang.Total buy count')); ?></th>
                                    <th><?php echo e(trans('lang.Total buy price')); ?></th>
                                    <th><?php echo e(trans('lang.Total take count')); ?></th>
                                    <th><?php echo e(trans('lang.Total take price')); ?></th>
                                    <th><?php echo e(trans('lang.ŞİRKƏTƏ TOPLAM ÖDƏNİŞ')); ?></th>
                                    <th><?php echo e(trans('lang.TOPLAM ALINAN FAİZLƏR')); ?></th>
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

<?php echo $__env->make('manager.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/manager/report/product_show.blade.php ENDPATH**/ ?>