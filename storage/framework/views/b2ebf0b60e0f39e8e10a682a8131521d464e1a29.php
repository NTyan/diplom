<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Orders'); ?>
    <div class="container my-5">
        <main role="main">

            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Мои заказы</h1>
                    <p class="lead text-muted">На этой странице вы можете посмотреть свои заказы</p>
                    <p>
                        <a href="#" class="btn btn-primary my-2">Создать заказ</a>
                        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                    </p>
                </div>
            </section>

            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">

                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <div class="card-body">
                                        <h4>Номер заказа: <?php echo e($order->number); ?></h4>
                                        <dl>
                                            <dt>Дата: </dt>
                                            <dd><?php echo e($order->create_at); ?></dd>

                                            <dt>Сумма:</dt>
                                            <dd><?php echo e($order->sum); ?></dd>
                                        </dl>
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-outline-secondary" href="/orders/<?php echo e($order->id); ?>">Просмотр</a>
                                            </div>
                                            <?php switch($order->status):
                                                case ('processing'): ?>
                                                    <small class="text-primary">
                                                <?php break; ?>

                                                <?php case ('canceled'): ?>
                                                    <small class="text-danger">
                                                <?php break; ?>

                                                <?php case ('confirmed'): ?>
                                                    <small class="text-warning">
                                                <?php break; ?>

                                                <?php case ('completed'): ?>
                                                    <small class="text-success">
                                                <?php break; ?>

                                                <?php case ('transit'): ?>
                                                    <small class="text-info">
                                                <?php break; ?>

                                                <?php default: ?>
                                                    <small class="text-secondary">
                                            <?php endswitch; ?>
                                            <?php echo e($order->status); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>

        </main>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /var/www/app/resources/views/lk/orders.blade.php ENDPATH**/ ?>