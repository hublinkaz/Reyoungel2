<?php $__env->startSection('title', 'HTML 5 Data Export'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatable-extension.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

<h3><?php echo e(trans('lang.Payments')); ?></h3>

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
									<th><?php echo e(trans('lang.Order id')); ?></th>
                                    <th><?php echo e(trans('lang.Date')); ?></th>
                                    <th><?php echo e(trans('lang.Manager')); ?></th>

                                    <th><?php echo e(trans('lang.Doctor Paid')); ?></th>
                                    <th><?php echo e(trans('lang.Manager Paid')); ?></th>
									<th><?php echo e(trans('lang.Approval Admin')); ?></th>

								</tr>
							</thead>
							<tbody>

                            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($doctor->doctor_paid != $doctor->manager_paid): ?>
                                    <tr >
                                     <td><a href="orders/detail/<?php echo e($doctor->order_id); ?>"><?php echo e($doctor->order_id); ?></a></td>
                                     <td><?php echo e($doctor->date); ?></td>
                                     <td><?php echo e($doctor->first_name); ?> <?php echo e($doctor->last_name); ?></td>

                                     <td><?php echo e(round($doctor->doctor_paid,1)); ?> Azn</td>
                                     <td><?php echo e($doctor->manager_paid); ?> Azn</td>
                                         


                                        <td>
                                            <form action="<?php echo e(route('payment.status',$doctor->order_id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                                <input  class="form-control" type="text"  name="manager_paid" disabled id="manager_paid" value="<?php echo e(round($doctor->doctor_paid-$doctor->manager_paid,1)); ?>" >
                                                <input   type="hidden"  name="paid"  value="<?php echo e(round($doctor->doctor_paid-$doctor->manager_paid,1)); ?>" >
                                                <input   type="hidden"  name="id"  value="<?php echo e($doctor->order_id); ?>" >
                                                <button type="submit" class="form-control btn btn-success btn-xs"  data-original-title="btn btn-success btn-xs"><?php echo e(trans('lang.Paid')); ?></button>
                                            </form>
                                        </td>

                                    </tr>
                                <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							</tbody>
							<tfoot>
								<tr>
                                    <th><?php echo e(trans('lang.Order id')); ?></th>
                                    <th><?php echo e(trans('lang.Date')); ?></th>
                                    <th><?php echo e(trans('lang.Manager')); ?></th>

                                    <th><?php echo e(trans('lang.Doctor Paid')); ?></th>
                                    <th><?php echo e(trans('lang.Manager Paid')); ?></th>
                                    <th><?php echo e(trans('lang.Approval Admin')); ?></th>


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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/payment/indexadmin.blade.php ENDPATH**/ ?>