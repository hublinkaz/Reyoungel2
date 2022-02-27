<?php $__env->startSection('title', 'HTML 5 Data Export'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatable-extension.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

<h3><?php echo e(trans('lang.Manager List')); ?></h3>
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
									<th><?php echo e(trans('lang.Phone Number')); ?></th>
									<th><?php echo e(trans('lang.Percentage')); ?></th>
									<th><?php echo e(trans('lang.Options')); ?></th>
								</tr>
							</thead>
							<tbody>

                            <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><img style="width: 100px;filter: drop-shadow(0px 0px 1px rgb(0 0 1 / 0.4));" src="https://hublink.az/public/images/media/16247058921624655281logonew1.svg">
                                    </td>
									<td><a href="manager/<?php echo e($manager->id); ?>"><?php echo e($manager->first_name); ?> <?php echo e($manager->last_name); ?></a></td>
									<td><?php echo e($manager->phone); ?></td>
									<td><?php echo e($manager->percentage_value); ?> %</td>
									<td><form action="<?php echo e(route('manager.delete',$manager->id)); ?>" method="POST">


                                            <a class="btn btn-primary" href="<?php echo e(route('manager.edit',$manager->id)); ?>"><?php echo e(trans('lang.Edit')); ?></a>

                                            <?php echo csrf_field(); ?>

                                        </form></td>
								</tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							</tbody>
							<tfoot>
								<tr>
                                    <th><?php echo e(trans('lang.Image')); ?></th>
                                    <th><?php echo e(trans('lang.Name')); ?></th>
                                    <th><?php echo e(trans('lang.Qty')); ?></th>
                                    <th><?php echo e(trans('lang.Price')); ?></th>
                                    <th><?php echo e(trans('lang.Options')); ?></th>

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

<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/manager/index.blade.php ENDPATH**/ ?>