<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php $__env->startSection('title', 'Новый заказ'); ?>
    <div class="container " >
        <form method="post" enctype="multipart/form-data" id="files"
              class="d-flex flex-column justify-content-center flex-wrap align-content-around"
              style="min-height: 300px;">
            <?php echo csrf_field(); ?>
            <input type="file" id="file" multiple="multiple" hidden name="inputFiles">
            <div class="btn btn-primary my-3" id="add_files" onclick="$('#file').click();">Загрузить файлы</div>
            <div class="alert alert-danger my-2" role="alert" hidden>
                <strong id="error"></strong>
            </div>
            <div id="stl_cont" ></div>
            <dl class="hidden_el" hidden>
                <dt>Желаемая дата готовности</dt>
                <dd>
                    <input type="date" class="form-control date" >
                </dd>
            </dl>
            <textarea id="comment" class="form-control  hidden_el comment" placeholder="Подробности по заказу для исполнителя" hidden></textarea>
            <div class="btn btn-primary my-3 hidden_el" id="send" hidden>Отправить</div>
        </form>
    </div>
    <script src="<?php echo e(asset('js/viewstl/build/stl_viewer.min.js')); ?>"></script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>

<script>


    $(document).ready(function () {

        let id = -1;
        let form_data = new FormData();
        let density = 0.00124;

        $("#file").change(function() {


            $('.alert-danger').prop("hidden", !this.checked);
            let files = $("#file")[0].files;

            for (let i=0; i<files.length; i++) {
                if( files[i].type !== "model/stl" ){
                    $('#error').html('Файлы должны быть типа stl<br>');
                    $('.alert-danger').removeAttr('hidden');
                    return 0;
                }

            }


            $('#add_files').text('Добавить файл');
            $('.hidden_el').removeAttr('hidden');

            $.each(files,function(key, input){

                ++id;

                form_data.append('file[]', input);

               $("#stl_cont").append('<div id="stl_' + id + '" class="my-5 d-flex justify-content-around stl_form" style="min-height: 200px"></div>');
               $("#stl_" + id).append([
                   '<div class="left"></div>',
                   '<div class="center"></div>',
                   '<div class="right"></div>',
               ]);

                let model = new StlViewer(
                    document.querySelector('#stl_' + id + ' .center'),
                    {
                        model_loaded_callback: function () {

                            let model_info = model.get_model_info(key);

                            let area = Math.round(model_info.area);
                            let volume = Math.round(model_info.volume);
                            let height = Math.round(model_info.dims.z);
                            let width = Math.round(model_info.dims.y);
                            let length = Math.round(model_info.dims.x);
                            let weight = Math.round(model_info.volume * density);

                            form_data.append('area[]', area);
                            form_data.append('volume[]', volume);
                            form_data.append('height[]',  height);
                            form_data.append('width[]',  width);
                            form_data.append('length[]',  length);

                            $(this.parent_element).closest('.stl_form').children('.left').append(
                                '<dl>' +
                                    '<dt> Площадь поверхности (мм кв)' +
                                    '</dt>' +
                                    '<dd>' + area +
                                    '</dd>' +

                                    '<dt> Объем (мм куб)' +
                                    '</dt>' +
                                    '<dd class="volume">' + volume +
                                    '</dd>' +

                                    '<dt> Размеры (мм)' +
                                    '</dt>' +
                                    '<dd>' + length + 'x' + width + 'x' + height +
                                    '</dd>' +

                                    '<dt> Вес (г/шт.)' +
                                    '</dt>' +
                                    '<dd class="weight">' + weight +
                                    '</dd>' +
                                '</dl>'
                            );

                            $(this.parent_element).closest('.stl_form').children('.right').append('' +
                                '<dl>' +
                                '<dt> Название модели' +
                                '</dt>' +
                                '<dd> <input type="text" class="form-control title" value=' + input.name.replace('.stl', '') + '>' +
                                '</dd>' +

                                '<dt> Тип пластика' +
                                '</dt>' +
                                '<dd> ' +
                                    '<select class="form-control">' +
                                    <?php $__currentLoopData = $plastic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    '<option> <?php echo e($item); ?> </option>' +
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    '</select>' +
                                '</dd>' +

                                '<dt> Цвет пластика' +
                                '</dt>' +
                                '<dd> ' +
                                '<input type="color" class="form-control model_color">' +
                                '</dd>' +

                                '<dt> Плотность заполнения (%)' +
                                '</dt>' +
                                '<dd> ' +
                                '<input type="range" class="custom-range model_fill" min="0" max="100" step="10" value=100 ><output>100</output>' +
                                '</dd>' +

                                '<dt> Количество (шт.)' +
                                '</dt>' +
                                '<dd> ' +
                                '<input type="number" class="form-control count" min="1" max="100"  value=1 >' +
                                '</dd>'

                        );

                            this.set_auto_resize(false);
                            this.set_auto_rotate(true);

                        },
                        jszip_path:"/js/jszip/dist/jszip.min.js",
                        models: [ {id:key, filename:URL.createObjectURL(input)}
                        ],
                    }
                );
                $("#stl_cont").append('<hr>');
            });

        });

        $(document).on('input', '.model_fill', function () {
            this.nextElementSibling.value = this.value;

            let volume = +$(this).closest('.stl_form').find('.volume').text();
            let weight = Math.round(this.value / 100 * volume * density);
            $(this).closest('.stl_form').find('.weight').text(weight);
        });

        $('#send').click(function () {

            $.each(form_data.getAll('file[]'), function (key, input) {
                form_data.append('title[]', $('#stl_' + key).find('.title').val());
                form_data.append('plastic[]', $('#stl_' + key).find('select').val());
                form_data.append('color[]', $('#stl_' + key).find('.model_color').val().replace('#', ''));
                form_data.append('filling[]', +$('#stl_' + key).find('.model_fill').val());
                form_data.append('count[]', +$('#stl_' + key).find('.count').val());
                form_data.append('weight[]', Math.round($('#stl_' + key).find('.volume').text() * density * $('#stl_' + key).find('.model_fill').val() / 100));
            });
            form_data.append('date', $('.date').val());
            form_data.append('comment', $('.comment').val());

            $.ajax({
                url: "/create-order/", // куда отправляем
                type: "post", // метод передачи
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                headers: {'X-CSRF-TOKEN':"<?php echo e(csrf_token()); ?>"},
                data: form_data,
                // после получения ответа сервера
                complete: function (mes) {

                    if (mes.status !== 200) {

                        alert("Ошибка");
                        return 0;
                    }

                    return window.location.href = '/add-executor';

                }
            });
        })

    })
</script>

<?php /**PATH /var/www/app/resources/views/order/newOrder.blade.php ENDPATH**/ ?>