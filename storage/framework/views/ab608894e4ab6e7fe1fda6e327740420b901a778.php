<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Executors'); ?>
    <div class="container my-5">
        <main role="main">

            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">

                        <?php $__currentLoopData = $orgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <div class="card-img-top "
                                     style="max-height: 200px; height:180px;
                                         background:url(<?php echo e($path[$org->id]); ?>) no-repeat center; background-size: contain">

                                </div>
                                <div class="card-body">
                                    <h4><?php echo e($org->name); ?></h4>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="/organization/<?php echo e($org->id); ?>" class="btn btn-sm btn-outline-secondary">Просмотр</a>
                                            <a href="/executor/<?php echo e($org->id); ?>" class="btn btn-sm btn-outline-primary">Выбрать</a>
                                        </div>
                                        <small class="text-muted">Рейтинг</small>
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
<?php /**PATH /var/www/app/resources/views/order/executors.blade.php ENDPATH**/ ?>