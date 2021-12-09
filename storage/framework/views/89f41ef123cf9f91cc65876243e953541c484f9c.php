<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Organization'); ?>
    <div class="container py-5">
        <div class="card pt-3">
            <img class="card-img-top w-25 align-self-center"
                 src="/storage/files/orgs/<?php echo e($org->id); ?>.jpg"
            >
            <div class="card-body">
                <h4 class="card-title text-center"><?php echo e($org->name); ?></h4>
                <ul class="list-group my-2">
                    <li class="list-group-item"><?php echo e($org::TYPES[$org->type]); ?></li>
                    <li class="list-group-item">Адрес: <?php echo e($org->jur_address); ?></li>
                    <li class="list-group-item">ИНН: <?php echo e($org->inn); ?></li>
                    <li class="list-group-item">КПП: <?php echo e($org->kpp); ?></li>
                    <li class="list-group-item">ОГРН: <?php echo e($org->ogrn); ?></li>
                    <li class="list-group-item">р/с: <?php echo e($org->payment_account); ?></li>
                </ul>
                <h4 class="card-title text-center">Цены</h4>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>Пластик</th>
                        <th>Цена за грамм</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($price->plastic); ?></td>
                            <td><?php echo e($price->price); ?>р.</td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <a href="#!" class="btn btn-primary">Редактировать</a>
                        <a href="#!" class="btn btn-success">Заказы</a>
                    </div>
                    <a href="#!" class="btn btn-danger">Удалить</a>
                </div>

            </div>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /var/www/app/resources/views/lk/org.blade.php ENDPATH**/ ?>