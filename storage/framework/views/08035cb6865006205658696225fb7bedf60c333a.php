<?php $__env->startSection('title', 'HTML 5 Data Export'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatable-extension.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

<h3><?php echo e(trans('lang.general report extract')); ?></h3>
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
									<th><?php echo e(trans('lang.TOPLAM GÖTÜRÜLƏN MAL QUTU')); ?></th>
									<th><?php echo e(trans('lang.TOPLAM GÖTÜRÜLƏN MAL MANATLA')); ?></th>
									<th><?php echo e(trans('lang.ŞİRKƏTƏ TOPLAM ÖDƏNİŞ')); ?></th>
									<th><?php echo e(trans('lang.TOPLAM ALINAN FAİZLƏR')); ?></th>

								</tr>
							</thead>
							<tbody>
                            <?php
                                $total_qty =0;
                                $total_amount =0;
                                $total_total_qty =0;
                                $total_total_amount =0;
                                $total_company_price =0;
                                $total_manager_price =0;
                            ?>

                            <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php
                                $total_qty +=$manager->qty;
                                $total_amount += round($manager->amount,1);
                                $total_total_qty +=$manager->total_qty;
                                $total_total_amount +=round($manager->total_amount,1);
                                $total_company_price +=round($manager->company_price,1);
                                $total_manager_price+=round($manager->manager_price,1);
                                ?>

                                    <tr>

                                        <td><?php echo e($manager->id); ?> </td>
                                        <td><?php echo e($manager->first_name); ?> <?php echo e($manager->last_name); ?></td>
                                        <td><?php echo e($manager->qty); ?></td>
                                        <td><?php echo e(round($manager->amount,1)); ?></td>
                                        <td><?php echo e($manager->total_qty); ?></td>
                                        <td><?php echo e(round($manager->total_amount,1)); ?></td>
                                        <td><?php echo e(round($manager->company_price,1)); ?></td>
                                        <td><?php echo e(round($manager->manager_price,1)); ?></td>


                                    </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <tr>

                                <td> </td>
                                <td><?php echo e(trans('lang.Total')); ?></td>
                                <td><?php echo e($total_qty); ?></td>
                                <td><?php echo e($total_amount); ?></td>
                                <td><?php echo e($total_total_qty); ?></td>
                                <td><?php echo e($total_total_amount); ?></td>
                                <td><?php echo e($total_company_price); ?></td>
                                <td><?php echo e($total_manager_price); ?></td>


                            </tr>

							</tbody>
							<tfoot>
								<tr>
                                    <th><?php echo e(trans('lang.Id')); ?></th>
                                    <th><?php echo e(trans('lang.Name')); ?></th>
                                    <th><?php echo e(trans('lang.Total buy count')); ?></th>
                                    <th><?php echo e(trans('lang.Total buy price')); ?></th>
                                    <th><?php echo e(trans('lang.TOPLAM GÖTÜRÜLƏN MAL QUTU')); ?></th>
                                    <th><?php echo e(trans('lang.TOPLAM GÖTÜRÜLƏN MAL MANATLA')); ?></th>
                                    <th><?php echo e(trans('lang.ŞİRKƏTƏ TOPLAM ÖDƏNİŞ')); ?></th>
                                    <th><?php echo e(trans('lang.TOPLAM ALINAN FAİZLƏR')); ?></th>

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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/report/manager_show.blade.php ENDPATH**/ ?>