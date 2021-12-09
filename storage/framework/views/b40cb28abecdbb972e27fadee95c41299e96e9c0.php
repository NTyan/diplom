<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Order'); ?>
    <div class="container py-5">
        <div class="card ">
            <div class="card-body d-flex justify-content-between">
                <h5 class="card-title">Заказ <?php echo e($order->number); ?></h5>
                <a href="#" class="btn btn-danger">Отменить</a>
            </div>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <div class="d-flex">
                            <div class="flex-column flex-fill">
                                <div class="p-2">
                                    <div class="p-2 font-weight-bold d-inline-flex">Размеры</div>
                                    <div class="p-2 d-inline-flex"><?php echo e($model->width); ?>х<?php echo e($model->height); ?></div>
                                </div>
                                <div class="p-2">
                                    <div class="p-2 font-weight-bold d-inline-flex">Объем</div>
                                    <div class="p-2 d-inline-flex"><?php echo e($model->volume); ?></div>
                                </div>
                                <div class="p-2">
                                    <div class="p-2 font-weight-bold d-inline-flex">Вес </div>
                                    <div class="p-2 d-inline-flex"><?php echo e($model->weight); ?></div>
                                </div>
                            </div>
                            <div class="p-2 flex-fill"><p class="font-weight-bold">Цвет </p><?php echo e($model->color); ?></div>
                            <div class="p-2 flex-fill"><p class="font-weight-bold">Пластик </p><?php echo e($model->plastic); ?></div>
                            <div class="p-2 flex-fill"><p class="font-weight-bold">Количество </p><?php echo e($model->count); ?></div>
                            <div class="p-2 flex-fill"><p class="font-weight-bold">Цена </p><?php echo e($model->price); ?></div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item">
                    Сумма: <?php echo e($order->sum); ?>

                    <?php if(!$order->is_paid): ?>
                        <a href="#" class="card-link">Оплатить</a>
                    <?php else: ?>
                        <p class="text-success">Оплачено</p>
                    <?php endif; ?>
                </li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Распечатать</a>
                <a href="#" class=" btn btn-primary">Чат с <?php echo e($org->name); ?></a>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /var/www/app/resources/views/lk/order.blade.php ENDPATH**/ ?>