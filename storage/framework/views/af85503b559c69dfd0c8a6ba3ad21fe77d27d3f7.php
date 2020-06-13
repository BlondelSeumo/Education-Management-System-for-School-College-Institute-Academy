 <?php if(session()->has('message-success')): ?>
 <div class="alert alert-success mb-25" role="alert">
 	<?php echo e(session()->get('message-success')); ?>

 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 		<span aria-hidden="true">&times;</span>
 	</button>
 </div>
 <?php elseif(session()->has('message-danger')): ?>
 <div class="alert alert-danger">
 	<?php echo e(session()->get('message-danger')); ?>

 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 		<span aria-hidden="true">&times;</span>
 	</button>
 </div>
 <?php endif; ?>


 <?php if(session()->has('message-success-delete')): ?>
 <div class="alert alert-success" role="alert">
 	<?php echo e(session()->get('message-success-delete')); ?>

 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 		<span aria-hidden="true">&times;</span>
 	</button>
 </div>
 <?php elseif(session()->has('message-danger-delete')): ?>
 <div class="alert alert-danger">
 	<?php echo e(session()->get('message-danger-delete')); ?>

 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 		<span aria-hidden="true">&times;</span>
 	</button>
 </div>
 <?php endif; ?>