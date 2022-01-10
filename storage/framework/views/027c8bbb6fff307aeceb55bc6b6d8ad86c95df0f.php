<?php $__env->startComponent('mail::layout'); ?>

<?php $__env->slot('header'); ?>



<?php $__env->endSlot(); ?>


<?php echo e($slot); ?>



<?php if(isset($subcopy)): ?>
<?php $__env->slot('subcopy'); ?>
<?php $__env->startComponent('mail::subcopy'); ?>
<?php echo e($subcopy); ?>

<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>
<?php endif; ?>


<?php $__env->slot('footer'); ?>
<?php $__env->startComponent('mail::footer'); ?>
© <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. <?php echo app('translator')->get('Все права защищены'); ?>
<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /var/www/app/vendor/laravel/framework/src/Illuminate/Mail/resources/views/html/message.blade.php ENDPATH**/ ?>