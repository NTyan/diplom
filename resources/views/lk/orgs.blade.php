<x-app-layout>
    @section('title', 'Бизнес')
    <div class="container my-5">
        <main role="main">

            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Мои организации</h1>
                    <p class="lead text-muted">На этой странице вы можете добавить организации, специализирующиеся на 3д печати, владельцем которых являетесь.</p>
                    <p>
                        <a href="#" class="btn btn-primary my-2" data-toggle="modal" data-target=".modal-data">Добавить новую организацию</a>
                    </p>
                </div>
            </section>

            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">

                        @foreach($orgs as $org)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <div class="card-img-top "
                                     style="max-height: 200px; height:180px;
                                         background:url({{$path[$org->id]}}) no-repeat center; background-size: contain">

                                </div>
                                <div class="card-body">
                                    <h4>{{$org->name}}</h4>
                                    <p class="card-text">{{$org->description}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="/organization/{{$org->id}}" class="btn btn-sm btn-outline-secondary">Просмотр</a>
                                            <a href="/org-orders/{{$org->id}}" class="btn btn-sm btn-outline-secondary">Заказы</a>
                                        </div>
                                        <small class="text-muted">
                                        @isset($prices[$org->id])
                                            Цены от <b>{{min(($prices[$org->id]))}}</b>р./г.
                                        @endisset
                                        @empty($prices[$org->id])
                                            Цены не указаны
                                        @endempty
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </main>
    </div>
    {{--    модальное окно редактирования личных данных--}}
    <div class="modal fade modal-data "  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <form method="POST" id="info" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Название*</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Тип организации*</label>
                        <select class="custom-select" name="type" id="type">
                            @foreach(App\Models\Organization::TYPES as $key=>$type)
                                <option value="{{$key}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон*</label>
                        <input type="text" name="phone" class="form-control" id="phone" maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="text" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Юридический адрес*</label>
                        <input type="text" name="address" class="form-control" id="address" required>
                    </div>
                    <div class="form-group">
                        <label for="inn">ИНН*</label>
                        <input type="text" name="inn" class="form-control" id="inn" minlength="12" maxlength="12" required>
                    </div>
                    <div class="form-group">
                        <label for="kpp">КПП*</label>
                        <input type="text" name="kpp" class="form-control" id="kpp" minlength="9" maxlength="9" required>
                    </div>
                    <div class="form-group">
                        <label for="ogrn">ОГРН*</label>
                        <input type="text" name="ogrn" class="form-control" id="ogrn" minlength="13" maxlength="13" required>
                    </div>
                    <div class="form-group">
                        <label for="payment">Рассчетный счет*</label>
                        <input type="text" name="payment" class="form-control" id="payment" minlength="20" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea class="form-control" name="description" id="description" ></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="file" class="form-control-file" id="file" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary edit-info" id="new-org">Добавить цены</button>
                        <a hidden data-toggle="modal" data-target=".modal-prices" id="show-price"></a>
                    </div>
                </form>
            </div>
            <div class="alert alert-danger" hidden role="alert">
                <strong>Что-то пошло не так!</strong> <p id="error"></p>
            </div>

        </div>

    </div>

    {{--    модальное окно редактирования цен --}}
    <div class="modal fade modal-prices "  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <form method="POST" id="price">
                    @csrf
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
                        <tr>
                            <td><select class="custom-select plastic">
                                    @foreach(App\Models\OrderModel::PLASTIC as $item)
                                        <option>{{$item}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" class="form-control price" ></td>
                            <td><div class="btn add-plastic" title="Применить"><i class="bi bi-plus-square text-black-50" ></i></div></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary " id="new-price">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
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
                '<td><div class="btn delete-plastic" title="Удалить"><i class="bi bi-trash-fill text-black-50"></i></div></td>' +
                '</tr>';
            $(this).closest('tr').before(add);

            $(this).closest('tr').find('.price').val('');

        });

        $("#new-org").on('click', function () {

            $('.alert-danger').attr("hidden",true);

            if(
                $('#name').val() === '' ||
                $('#address').val() === '' ||
                $('#inn').val() === '' ||
                $('#kpp').val() === '' ||
                $('#ogrn').val() === '' ||
                $('#email').val() === '' ||
                $('#phone').val() === '' ||
                $('#payment').val() === ''
            )
            {
                $('#error').html('Заполните все поля!');
                $('.alert-danger').removeAttr('hidden');
                return 0;
            }

            var form_data = new FormData($('#info')[0]);

            $.ajax({
                url: "/add-new-org", // куда отправляем
                type: "post", // метод передачи
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
                data: form_data,
                // после получения ответа сервера
                complete: function (mes) {

                    if (mes.status !== 200) {
                        $('#error').html(mes.responseJSON.message + '<br>');
                        $('.alert-danger').removeAttr('hidden');

                        return 0;
                    }

                    $('#show-price').trigger('click');
                }
            });

            $("#new-price").on('click', function () {

                $('.alert-danger').attr("hidden",true);

                const $pricesAndPlastic = {};

                let $plastics = $('.update-plastic');
                let $prices = $('.update-price');

                for(let i = 0; i < $plastics.length; i++) {
                    $pricesAndPlastic[$plastics[i].value] = $prices[i].value;
                }

                $.ajax({
                    url: "/add-new-price", // куда отправляем
                    type: "post", // метод передачи
                    headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
                    dataType: "json",
                    data: {
                        'prices' : JSON.stringify($pricesAndPlastic)
                    },
                    // после получения ответа сервера
                    complete: function (mes) {

                        if (mes.status !== 200) {
                            $('#error').html(mes.responseJSON.message + '<br>');
                            $('.alert-danger').removeAttr('hidden');
                            return 0;
                        }

                        window.location.href = '/organization/' + mes.responseText;
                    }
                });
            })
        })
    })
</script>
