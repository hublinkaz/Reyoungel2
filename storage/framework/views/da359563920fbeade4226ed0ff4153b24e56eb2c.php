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
									<th><?php echo e(trans('lang.Doctor Name')); ?></th>
									<th><?php echo e(trans('lang.Manager Name')); ?></th>
									<th><?php echo e(trans('lang.Phone')); ?></th>
									<th><?php echo e(trans('lang.Email')); ?></th>
									<th><?php echo e(trans('lang.Work Address')); ?></th>
									<th><?php echo e(trans('lang.Workplace')); ?></th>
									<th><?php echo e(trans('lang.Card identity')); ?></th>
									<th><?php echo e(trans('lang.Birth Day')); ?></th>

								</tr>
							</thead>
							<tbody>
<?php
    $count=1;
?>
                            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>

                                        <td><?php echo e($count++); ?> </td>
                                        <td><?php echo e($doctor->first_name); ?> <?php echo e($doctor->last_name); ?> </td>
                                        <td><?php echo e($doctor->manager_first_name); ?> <?php echo e($doctor->manager_last_name); ?> </td>
                                        <td><?php echo e($doctor->phone); ?></td>
                                        <td><?php echo e($doctor->email); ?></td>
                                     <td><?php echo e($doctor->workplace); ?></td>
                                     <td><?php echo e($doctor->location); ?></td>
                                        <td><?php echo e($doctor->card_number); ?></td>
                                        <td><?php echo e($doctor->birth_date); ?></td>



                                    </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							</tbody>
							<tfoot>
								<tr>
                                    <th><?php echo e(trans('lang.No')); ?></th>
                                    <th><?php echo e(trans('lang.Doctor Name')); ?></th>
                                    <th><?php echo e(trans('lang.Manager Name')); ?></th>
                                    <th><?php echo e(trans('lang.Phone')); ?></th>
                                    <th><?php echo e(trans('lang.Email')); ?></th>
                                    <th><?php echo e(trans('lang.Workplace')); ?></th>
                                    <th><?php echo e(trans('lang.Location')); ?></th>
                                    <th><?php echo e(trans('lang.Card identity')); ?></th>
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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/report/doctors_info.blade.php ENDPATH**/ ?>