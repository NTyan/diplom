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
                 src="<?php echo e($imgPath); ?>"
            >
            <div class="card-body">
                <h4 class="card-title text-center"><?php echo e($org->name); ?></h4>
                <dl>
                    <dt>E-mail</dt>
                    <dd><?php echo e($org->email); ?></dd>
                    <dt>Phone</dt>
                    <dd><?php echo e($org->phone_number); ?></dd>
                </dl>
                <?php if(Auth::user()->id === $org->user_id): ?>
                    <a href="/org-orders/<?php echo e($org->id); ?>" class="btn btn-success">Заказы</a>
                <?php endif; ?>
                <ul class="list-group my-2">
                    <li class="list-group-item"><?php echo e($org::TYPES[$org->type]); ?></li>
                    <li class="list-group-item">Адрес: <?php echo e($org->jur_address); ?></li>
                    <li class="list-group-item">ИНН: <?php echo e($org->inn); ?></li>
                    <li class="list-group-item">КПП: <?php echo e($org->kpp); ?></li>
                    <li class="list-group-item">ОГРН: <?php echo e($org->ogrn); ?></li>
                    <li class="list-group-item">р/с: <?php echo e($org->payment_account); ?></li>
                </ul>
                <?php if(Auth::user()->id === $org->user_id): ?>
                    <a href="#!" class="btn-link" data-toggle="modal" data-target=".modal-data">Редактировать данные организации</a>
                <?php endif; ?>
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
                <h4 class="card-title text-center">О нас</h4>
                <div class="bg-secondary text-white p-3"><?php echo e($org->description); ?></div>

                <?php if(Auth::user()->id === $org->user_id): ?>
                    <div class="card-body d-flex justify-content-between">
                        <a href="#!" class="btn-link" data-toggle="modal" data-target=".modal-prices">Редактировать цены</a>
                        <a href="/delete-org/<?php echo e($org->id); ?>" class="btn-link text-danger">Удалить организацию</a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div class="modal fade modal-data "  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <form method="POST" id="info" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Название</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?php echo e($org->name); ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="<?php echo e($org->phone_number); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="<?php echo e($org->email); ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес</label>
                        <input type="text" name="address" class="form-control" id="address" value="<?php echo e($org->jur_address); ?>">
                    </div>
                    <div class="form-group">
                        <label for="inn">ИНН</label>
                        <input type="text" name="inn" class="form-control" id="inn" value="<?php echo e($org->inn); ?>">
                    </div>
                    <div class="form-group">
                        <label for="kpp">КПП</label>
                        <input type="text" name="kpp" class="form-control" id="kpp" value="<?php echo e($org->kpp); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ogrn">ОГРН</label>
                        <input type="text" name="ogrn" class="form-control" id="ogrn" value="<?php echo e($org->ogrn); ?>">
                    </div>
                    <div class="form-group">
                        <label for="payment">Рассчетный счет</label>
                        <input type="text" name="payment" class="form-control" id="payment" value="<?php echo e($org->payment_account); ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea class="form-control" name="description" id="description" ><?php echo e($org->description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="file" class="form-control-file" id="file">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary edit-info" data-id="<?php echo e($org->id); ?>">Сохранить изменения</button>
                    </div>
                </form>
            </div>
                <div class="alert alert-danger" hidden role="alert">
                    <strong>Что-то пошло не так!</strong> <p id="error"></p>
                </div>

        </div>

    </div>

    
    <div class="modal fade modal-prices "  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <form method="POST" id="price">
                    <?php echo csrf_field(); ?>
                    <h4 class="card-title text-center">Цены</h4>
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th>Пластик</th>
                            <th>Цена за грамм, р.</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><input class="form-control plastic update-plastic"  value="<?php echo e($price->plastic); ?>" disabled></td>
                                <td><input class="form-control price update-price"  value="<?php echo e($price->price); ?>"></td>
                                <td><div class="btn delete-plastic" data-id="<?php echo e($price->id); ?>"><i class="bi bi-trash-fill text-black-50"></i></div></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><select class="custom-select plastic">
                                    <?php $__currentLoopData = $plastic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option><?php echo e($item); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td><input type="text" class="form-control price" ></td>
                            <td><div class="btn add-plastic"><i class="bi bi-plus-square text-black-50"></i></div></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary edit-price" data-id="<?php echo e($org->id); ?>">Сохранить изменения</button>
                    </div>
                </form>
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

        $(document).on('click', '.delete-plastic', function () {
            $(this).closest('tr').remove();
        });

        $(".add-plastic").on('click', function () {
            $plastic_array = [];

            $item_price = $(this).closest('tr').find('.price').val();
            $item_plastic = $(this).closest('tr').find('.plastic').val();

            for(let i = 0; i < $('.plastic').length; i++) {
                $plastic_array.push($('.plastic')[i].value);
            }

            let findDuplicates = arr => arr.filter((item, index) => arr.indexOf(item) != index);
            findDuplicates($plastic_array);

            if($item_price === '' || isNaN($item_price) || findDuplicates($plastic_array).length > 0) {
                return 0;
            }

            let add = '<tr>' +
                       ' <td><input class="form-control plastic update-plastic" value=' + $item_plastic + ' disabled=""></td>' +
                       ' <td><input class="form-control price update-price" value=' + $item_price + '></td>' +
                        '<td><div class="btn delete-plastic" data-id="8"><i class="bi bi-trash-fill text-black-50"></i></div></td>' +
                    '</tr>';
            $(this).closest('tr').before(add);

        });

        $(".edit-info").on('click', function () {
            var id = $(this).data('id');
            var form_data = new FormData($('#info')[0]);
            form_data.append('id', id);

            $.ajax({
                url: "/edit-info", // куда отправляем
                type: "post", // метод передачи
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                headers: {'X-CSRF-TOKEN':"<?php echo e(csrf_token()); ?>"},
                data: form_data,
                // после получения ответа сервера
                complete: function (mes) {

                    if (mes.status !== 200) {
                        $('#error').html(mes.responseJSON.message + '<br>');
                        $('.alert-danger').removeAttr('hidden');

                        return 0;
                    }

                    window.location.reload();
                }
            });
        });
        $(".edit-price").on('click', function () {

            let org_id = $(this).data("id");
            const $pricesAndPlastic = {};

            let $plastics = $('.update-plastic');
            let $prices = $('.update-price');

            for(let i = 0; i < $plastics.length; i++) {
                $pricesAndPlastic[$plastics[i].value] = $prices[i].value;
            }

            $.ajax({
                url: "/edit-price", // куда отправляем
                type: "post", // метод передачи
                headers: {'X-CSRF-TOKEN':"<?php echo e(csrf_token()); ?>"},
                dataType: "json",
                data: {
                    'org_id' : org_id,
                    'prices' : JSON.stringify($pricesAndPlastic)
                },
                // после получения ответа сервера
                complete: function (mes) {

                    if (mes.status !== 200) {
                        alert('error');
                        return 0;
                    }

                    window.location.reload();
                }
            });

        })
    })
</script>
<?php /**PATH /var/www/app/resources/views/lk/org.blade.php ENDPATH**/ ?>