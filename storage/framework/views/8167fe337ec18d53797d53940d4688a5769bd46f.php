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
									<th><?php echo e(trans('lang.Name')); ?></th>
									<th><?php echo e(trans('lang.Phone')); ?></th>
									<th><?php echo e(trans('lang.Workplace')); ?></th>
									<th><?php echo e(trans('lang.Location')); ?></th>
									<th><?php echo e(trans('lang.Product Name')); ?></th>
									<th><?php echo e(trans('lang.Units')); ?></th>
									<th><?php echo e(trans('lang.Price')); ?></th>
									<th><?php echo e(trans('lang.Deposit Date')); ?></th>
									<th><?php echo e(trans('lang.Paid Date')); ?></th>
									<th><?php echo e(trans('lang.Paid')); ?></th>
								</tr>
							</thead>
							<tbody>

                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if($payment->price ==0 AND $payment->paid == 0): ?>
                                    <tr>

                                        <td><?php echo e($count++); ?> </td>
                                        <td><?php echo e($payment->first_name); ?> <?php echo e($payment->last_name); ?> </td>
                                        <td><?php echo e($payment->phone); ?></td>
                                        <td><?php echo e($payment->workplace); ?></td>
                                        <td><?php echo e($payment->location); ?></td>
                                        <td><?php echo e($payment->product_name); ?></td>
                                        <td><?php echo e($payment->units); ?></td>
                                        <td><?php echo e(trans('lang.Gift')); ?></td>
                                        <td><?php echo e($payment->created); ?></td>
                                        <td><?php echo e(trans('lang.Gift')); ?></td>
                                        <td><?php echo e(trans('lang.Gift')); ?></td>


                                    </tr>
                                    <?php else: ?>

                                    <tr>
                                        <td><?php echo e($count++); ?> </td>
                                        <td><?php echo e($payment->first_name); ?> <?php echo e($payment->last_name); ?> </td>
                                        <td><?php echo e($payment->phone); ?></td>
                                        <td><?php echo e($payment->workplace); ?></td>
                                        <td><?php echo e($payment->location); ?></td>
                                        <td><?php echo e($payment->product_name); ?></td>
                                        <td><?php echo e($payment->units); ?></td>
                                        <td><?php echo e(round($payment->price,1)); ?></td>
                                        <td><?php echo e($payment->created); ?></td>
                                        <td><?php echo e($payment->paid_created); ?></td>
                                        <td><?php echo e(round($payment->paid,1)); ?></td>

                                    </tr>
                                    <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <td></td>
                                <td><?php echo e(trans('lang.Total Product Number')); ?> :</td>
                                <td><?php echo e($totalcount); ?></td>
                                <td><?php echo e(trans('lang.Total Amound')); ?> :</td>
                                <td><?php echo e(round($amount,1)); ?> Azn</td>
                                <td><?php echo e(trans('lang.Total Payment Amount')); ?> :</td>
                                <td><?php echo e(round($paid,1)); ?> Azn</td>
                                <td><?php echo e(trans('lang.Total Balance Debt')); ?> :</td>
                                <td><?php echo e(round($amount,1)-round($paid,1)); ?> Azn</td>
                                <td></td>
                                <td></td>

                            </tr>
							</tbody>
							<tfoot>
								<tr>
                                    <th><?php echo e(trans('lang.No')); ?></th>
                                    <th><?php echo e(trans('lang.Name')); ?></th>
                                    <th><?php echo e(trans('lang.Phone')); ?></th>
                                    <th><?php echo e(trans('lang.Workplace')); ?></th>
                                    <th><?php echo e(trans('lang.Location')); ?></th>
                                    <th><?php echo e(trans('lang.Product Name')); ?></th>
                                    <th><?php echo e(trans('lang.Units')); ?></th>
                                    <th><?php echo e(trans('lang.Price')); ?></th>
                                    <th><?php echo e(trans('lang.Deposit Date')); ?></th>
                                    <th><?php echo e(trans('lang.Paid Date')); ?></th>
                                    <th><?php echo e(trans('lang.Paid')); ?></th>

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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/report/doctor_show.blade.php ENDPATH**/ ?>