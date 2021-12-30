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
                    <?php if(isset($org)): ?>
                        <h1 class="jumbotron-heading">Заказы организации</h1>
                        <p class="lead text-muted">На этой странице вы можете посмотреть заказы своей организации</p>
                    <?php endif; ?>
                    <?php if(empty($org)): ?>
                        <h1 class="jumbotron-heading">Мои заказы</h1>
                        <p class="lead text-muted">На этой странице вы можете посмотреть свои заказы</p>
                        <p>
                            <a href="<?php echo e(url('/show-page')); ?>" class="btn btn-primary my-2">Создать заказ</a>
                            <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                        </p>
                    <?php endif; ?>
                </div>
            </section>

            <table class="table table-hover table_sort" >
                <thead class="thead-dark cursor-pointer">
                <tr>
                    <th>#</th>
                    <th>Номер заказа</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($key +1); ?></th>
                            <td>
                                <a class="btn btn-outline-dark" href="<?php echo e(url('/orders/' . $order->id)); ?>">
                                <?php echo e($order->number); ?>

                                </a>
                            </td>
                            <td>
                                <?php if(isset($order->status)): ?>
                                    <?php switch($order->status):

                                        case ('processing'): ?>
                                        <span class="badge badge-primary">
                                        <?php break; ?>

                                            <?php case ('canceled'): ?>
                                        <span class="badge badge-danger">
                                        <?php break; ?>

                                            <?php case ('confirmed'): ?>
                                        <span class="badge badge-warning">
                                        <?php break; ?>

                                            <?php case ('completed'): ?>
                                        <span class="badge badge-success">
                                        <?php break; ?>

                                            <?php case ('transit'): ?>
                                        <span class="badge badge-info">
                                        <?php break; ?>

                                            <?php default: ?>
                                        <span class="badge badge-secondary">
                                    <?php endswitch; ?>
                                            <?php echo e(App\Models\Order::STATUS[$order->status]); ?></span>
                                        <?php endif; ?>
                            </td>
                            <td><?php echo e($order->created_at); ?></td>
                            <td>
                                <?php if($order->is_paid): ?>
                                    <i class="bi bi-credit-card-2-front-fill text-success"></i>
                                <?php else: ?>
                                    <i class="bi bi-credit-card-2-front-fill text-danger"></i>
                                <?php endif; ?>
                                <?php echo e(number_format($order->sum)); ?>р.
                            </td>
                        </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </main>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const getSort = ({ target }) => {
            const order = (target.dataset.order = -(target.dataset.order || -1));
            const index = [...target.parentNode.cells].indexOf(target);
            const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
            const comparator = (index, order) => (a, b) => order * collator.compare(
                a.children[index].innerHTML,
                b.children[index].innerHTML
            );

            for(const tBody of target.closest('table').tBodies)
                tBody.append(...[...tBody.rows].sort(comparator(index, order)));

            for(const cell of target.parentNode.cells)
                cell.classList.toggle('sorted', cell === target);
        };

        document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));

    });
</script>
<?php /**PATH /var/www/app/resources/views/lk/orders.blade.php ENDPATH**/ ?>