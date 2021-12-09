<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Profile'); ?>
    <div class="container my-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo e(Auth::user()->name); ?></h4>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo e(Auth::user()->email); ?></h6>
                <a href="#!" class="card-link">Сменить пароль</a>
                <a href="#!" class="card-link">Удалить аккаунт</a>
            </div>
        </div>
        <div class="d-flex justify-content-between my-5">
            <a href="<?php echo e(route('orders')); ?>" class="btn w-100 p-0 mr-3">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Мои заказы</h4>
                    </div>
                </div>
            </a>
            <a href="<?php echo e(route('orgs')); ?>" class="btn w-100 p-0 ml-3">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Для бизнеса</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /var/www/app/resources/views/lk/profile.blade.php ENDPATH**/ ?>