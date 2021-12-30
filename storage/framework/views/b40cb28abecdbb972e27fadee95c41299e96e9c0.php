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
                <h5 class="card-title">
                    Заказ <?php echo e($order->number); ?>

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
                        <?php echo e(App\Models\Order::STATUS[$order->status]); ?>

                            </span>
                </h5>
                <?php if($role === "customer"): ?>
                <a href="#" class="btn btn-danger">Отменить</a>
                <?php endif; ?>
            </div>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <div class="p-2 flex-fill"><b>Название:</b> <?php echo e($model->title); ?></div>
                        <table class="table table-hover table-info">
                            <tbody>
                            <tr>
                                <th scope="row"><?php echo e($key +1); ?></th>
                                <td>
                                    <dt>Размеры</dt>
                                    <dd><?php echo e($model->width); ?>х<?php echo e($model->height); ?>х<?php echo e($model->length); ?></dd>

                                    <dt>Объем</dt>
                                    <dd><?php echo e($model->volume); ?></dd>

                                    <dt>Вес</dt>
                                    <dd><?php echo e($model->weight); ?></dd>
                                </td>
                                <td>
                                    <dt>Цвет</dt>
                                    <dd><?php echo e($model->color); ?></dd>
                                </td>
                                <td>
                                    <dt>Пластик</dt>
                                    <dd><?php echo e($model->plastic); ?></dd>
                                </td>
                                <td>
                                    <dt>Количество</dt>
                                    <dd><?php echo e($model->count); ?></dd>
                                </td>
                                <td>
                                    <dt>Цена</dt>
                                    <dd> <?php echo e($model->price); ?></dd>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item font-weight-bold">
                    <div class="d-flex flex-row">
                        <div>
                            Сумма: <?php echo e($order->sum); ?> р.
                            <?php if(!$order->is_paid && $role === "customer"): ?>
                                <a href="#" class="card-link">Оплатить</a>
                            <?php elseif(!$order->is_paid && $role === "executor"): ?>
                                <p class="text-danger">Неоплачено</p>
                            <?php else: ?>
                                <p class="text-success">Оплачено</p>
                            <?php endif; ?>
                        </div>
                    <?php if($role === "executor" && $order->status === "processing"): ?>
                        <div class="ml-2 align-self-center">
                            <a href="#" class="btn btn-sm btn-info status" data-id="<?php echo e($order->id); ?>">Подтвердить оплату</a>
                        </div>
                    <?php endif; ?>
                    </div>
                </li>
                <?php if($order->date_of_receiving): ?>
                <li class="list-group-item ">
                   <b> Желаемая дата получения: </b><?php echo e($order->date_of_receiving); ?>

                </li>
                <?php endif; ?>
                <?php if($order->comment): ?>
                <li class="list-group-item ">
                   <b> Комментарий: </b> <?php echo e($order->comment); ?>

                </li>
                <?php endif; ?>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Распечатать</a>
                <a href="#" class=" btn btn-primary">Чат с <?php echo e($name); ?></a>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>

<script>
    $(document).ready(function () {
        $(document).on('click', '.status', function () {
            let order_id = $(this).data('id');

            $.ajax({
                url: "/order-status-paid", // куда отправляем
                type: "post", // метод передачи
                dataType: 'json',
                headers: {'X-CSRF-TOKEN':"<?php echo e(csrf_token()); ?>"},
                data: {
                    'order_id' : order_id
                },
                // после получения ответа сервера
                complete: function (mes) {
                    if (mes.status !== 200) {
                        alert("Ошибка");
                        return 0;
                    }

                    window.location.reload();
                }
            });
        });
    })
</script>
<?php /**PATH /var/www/app/resources/views/lk/order.blade.php ENDPATH**/ ?>