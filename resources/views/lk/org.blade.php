<x-app-layout>
    @section('title', 'Организация')
    <div class="container py-5">
        <div class="card pt-3">
            <img class="card-img-top w-25 align-self-center"
                 src="{{$imgPath}}"
            >
            <div class="card-body">
                <h4 class="card-title text-center">{{$org->name}}</h4>
                <dl>
                    <dt>E-mail</dt>
                    <dd>{{$org->email}}</dd>
                    <dt>Phone</dt>
                    <dd>{{$org->phone_number}}</dd>
                </dl>
                @if(Auth::user()->id === $org->user_id)
                    <a href="/org-orders/{{$org->id}}" class="btn btn-success">Заказы</a>
                @endif
                <ul class="list-group my-2">
                    <li class="list-group-item">{{$org::TYPES[$org->type]}}</li>
                    <li class="list-group-item">Адрес: {{$org->jur_address}}</li>
                    <li class="list-group-item">ИНН: {{$org->inn}}</li>
                    <li class="list-group-item">КПП: {{$org->kpp}}</li>
                    <li class="list-group-item">ОГРН: {{$org->ogrn}}</li>
                    <li class="list-group-item">р/с: {{$org->payment_account}}</li>
                </ul>
                @if(Auth::user()->id === $org->user_id)
                    <a href="#!" class="btn-link" data-toggle="modal" data-target=".modal-data">Редактировать данные организации</a>
                @endif
                <h4 class="card-title text-center">Цены</h4>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>Пластик</th>
                        <th>Цена за грамм</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($prices as $price)
                        <tr>
                            <td>{{$price->plastic}}</td>
                            <td>{{$price->price}}р.</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h4 class="card-title text-center">О нас</h4>
                <div class="bg-secondary text-white p-3">{{$org->description}}</div>

                @if(Auth::user()->id === $org->user_id)
                    <div class="card-body d-flex justify-content-between">
                        <a href="#!" class="btn-link" data-toggle="modal" data-target=".modal-prices">Редактировать цены</a>
                        <a href="/delete-org/{{$org->id}}" class="btn-link text-danger">Удалить организацию</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
{{--    модальное окно редактирования личных данных--}}
    <div class="modal fade modal-data "  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <form method="POST" id="info" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Название</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$org->name}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="text" name="phone" class="form-control" id="phone" maxlength="11" value="{{$org->phone_number}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{$org->email}}">
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес</label>
                        <input type="text" name="address" class="form-control" id="address" value="{{$org->jur_address}}">
                    </div>
                    <div class="form-group">
                        <label for="inn">ИНН</label>
                        <input type="text" name="inn" class="form-control" id="inn" value="{{$org->inn}}" minlength="12" maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="kpp">КПП</label>
                        <input type="text" name="kpp" class="form-control" id="kpp" value="{{$org->kpp}}" minlength="9" maxlength="9">
                    </div>
                    <div class="form-group">
                        <label for="ogrn">ОГРН</label>
                        <input type="text" name="ogrn" class="form-control" id="ogrn" value="{{$org->ogrn}}" minlength="13" maxlength="13">
                    </div>
                    <div class="form-group">
                        <label for="payment">Рассчетный счет</label>
                        <input type="text" name="payment" class="form-control" id="payment" value="{{$org->payment_account}}" minlength="20" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea class="form-control" name="description" id="description" >{{$org->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="file" class="form-control-file" id="file">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary edit-info" data-id="{{$org->id}}">Сохранить изменения</button>
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
                        @foreach($prices as $price)
                            <tr>
                                <td><input class="form-control plastic update-plastic"  value="{{$price->plastic}}" disabled></td>
                                <td><input class="form-control price update-price"  value="{{$price->price}}"></td> 
                                <td><div class="btn delete-plastic" title="Удалить"><i class="bi bi-trash-fill text-black-50"></i></div></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><select class="custom-select plastic">
                                    @foreach($plastic as $item)
                                        <option>{{$item}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" class="form-control price" ></td>
                            <td><div class="btn add-plastic" title="Применить"><i class="bi bi-plus-square text-black-50"></i></div></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary edit-price" data-id="{{$org->id}}">Сохранить изменения</button>
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
                        '<td><div class="btn delete-plastic" ><i class="bi bi-trash-fill text-black-50"></i></div></td>' +
                    '</tr>';
            $(this).closest('tr').before(add);
            $(this).closest('tr').find('.price').val('');

        });

        $(".edit-info").on('click', function () {

            $('.alert-danger').attr("hidden",true);

            var id = $(this).data('id');
            var form_data = new FormData($('#info')[0]);

            form_data.append('id', id);

            $.ajax({
                url: "/edit-info", // куда отправляем
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

                    window.location.reload();
                }
            });
        });
        $(".edit-price").on('click', function () {

            $('.alert-danger').attr("hidden",true);

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
                headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
                dataType: "json",
                data: {
                    'org_id' : org_id,
                    'prices' : JSON.stringify($pricesAndPlastic)
                },
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

        })
    })
</script>
