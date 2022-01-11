<x-app-layout>
    @section('title', 'Заказ')
    <div class="container py-5">
        <div class="card " id="card">
            <div class="card-body d-flex justify-content-between">
                <h5 class="card-title">
                    Заказ {{$order->number}}
                        @switch($order->status)

                            @case('processing')
                            <span class="badge badge-primary">
                            @break

                            @case('canceled')
                            <span class="badge badge-danger">
                            @break

                            @case('confirmed')
                            <span class="badge badge-warning">
                            @break

                            @case('completed')
                            <span class="badge badge-success">
                            @break

                            @case('transit')
                            <span class="badge badge-info">
                            @break

                            @default
                            <span class="badge badge-secondary">
                        @endswitch
                        {{App\Models\Order::STATUS[$order->status]}}
                            </span>
                </h5>
                @if($role === "customer" && ($order->status === 'processing' || $order->status === 'confirmed'))
                    <div><a href="#" class="btn btn-danger" id="cancel_order" data-id="{{$order->id}}">Отменить</a></div>
                @endif
                @if($role === "executor" && $order->status === 'confirmed' )
                    <div><a href="#" class="btn btn-info" id="transit_order" data-id="{{$order->id}}">Отправлен</a></div>
                @endif
                @if($role === "customer" && $order->status === 'transit' )
                    <div><a href="#" class="btn btn-success" id="completed_order" data-id="{{$order->id}}">Подтвердить получение</a></div>
                @endif
            </div>
            <ul class="list-group list-group-flush">
                @foreach($models as $key => $model)
                    <li class="list-group-item">
                        <div class="p-2 flex-fill"><b>{{$model->title}}</b> </div>
                        <table class="table table-info" id="excel">
                            <tbody>
                            <tr>
                                <th scope="row">{{$key +1}}</th>
                                <td>
                                    <dt>Размеры</dt>
                                    <dd>{{$model->width}} мм. х {{$model->height}} мм. х {{$model->length}} мм.</dd>

                                    <dt>Объем</dt>
                                    <dd>{{$model->volume}} мм. куб</dd>

                                    <dt>Вес</dt>
                                    <dd>{{$model->weight}} г.</dd>
                                </td>
                                <td>
                                    <dt>Цвет</dt>
                                    <dd>
                                        <input type="color" value="{{$model->color}}" disabled>
                                    </dd>
                                </td>
                                <td>
                                    <dt>Пластик</dt>
                                    <dd>{{$model->plastic}}</dd>
                                </td>
                                <td>
                                    <dt>Количество</dt>
                                    <dd>{{$model->count}} шт.</dd>
                                </td>
                                <td>
                                    <dt>Цена</dt>
                                    <dd> {{number_format($model->price,0,'.',' ')}}р.</dd>
                                </td>
                                <td class="remove">
                                    <a href="/file/{{$order->id}}/{{$model->id}}"><i class="bi bi-file-earmark-arrow-down"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </li>
                @endforeach
                <li class="list-group-item font-weight-bold">
                    <div class="d-flex flex-row">
                        <div>
                            Сумма: {{number_format($order->sum,0,'.',' ')}}р.
                            @if(!$order->is_paid && $role === "customer" && $order->status !== 'canceled')
                                <a href="#" class="card-link remove">Оплатить</a>
                            @elseif((!$order->is_paid && $role === "executor") || (!$order->is_paid && $role === "customer" && $order->status === 'canceled'))
                                <p class="text-danger">Неоплачено</p>
                            @else
                                <p class="text-success">Оплачено</p>
                            @endif
                        </div>
                    @if($role === "executor" && $order->status === "processing")
                        <div class="ml-2 align-self-center remove">
                            <a href="#" class="btn btn-sm btn-info status" data-id="{{$order->id}}">Подтвердить оплату</a>
                        </div>
                    @endif
                    </div>
                </li>
                @if($order->date_of_receiving)
                <li class="list-group-item ">
                   <b> Желаемая дата получения: </b>{{$order->date_of_receiving->format('d.m.y')}}
                </li>
                @endif
                @if($order->comment)
                <li class="list-group-item ">
                   <b> Комментарий: </b> {{$order->comment}}
                </li>
                @endif
            </ul>
            <div class="card-body remove">
                <a href="#" class="card-link" id="print">Распечатать</a>
                <a href="#!" class="btn btn-primary" id="chat"
                   data-toggle="modal" data-target=".modal-data"
                   data-order="{{$order->id}}"
                   data-role="{{$role}}">Чат с {{ $name }}</a>
            </div>
        </div>
    </div>

    {{--    модальное окно чата --}}
    <div class="modal fade modal-data " id="modal_hide" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-3">
                <div class="card-header">
                    <h4 class="card-title-chat"><strong>Чат</strong></h4>
                    @if($role === 'customer')
                        <a class="btn btn-xs btn-info" href="/organization/{{$order->organization_id}}" data-abc="true">{{ $name }}</a>
                    @endif
                </div>
                <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:400px !important;">


                    <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                        <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                        <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
                    </div>

                </div>
                <div class="publisher bt-1 border-light">
                    @if($role === 'customer')
                        <img class="avatar avatar-xs rounded-circle" src="https://img.icons8.com/color/36/000000/administrator-male.png">
                    @else
                        <img class="avatar avatar-xs rounded-circle" id="org_img">
                    @endif
                    <input class="publisher-input" type="text" id="input_message" placeholder="Новое сообщение">
                    <a class="publisher-btn text-info" id="send_message"  href="#"
                        data-role="{{$role}}"
                        data-order="{{$order->id}}">
                        <i class="bi bi-send"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

<script>

    $(document).ready(function () {

        let timerId;

        let options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            timezone: 'UTC',
            hour: 'numeric',
            minute: 'numeric',
        };

        const targetNode = document.getElementById('modal_hide');
        const config = { attributes: true};
        const callback = function(mutationsList, observer) {
            for(const mutation of mutationsList) {
                if (mutation.attributeName === 'aria-hidden') {
                    if(!$("#modal_hide").hasClass("show"))
                        clearInterval(timerId);
                }
            }
        };

        const observer = new MutationObserver(callback);
        observer.observe(targetNode, config);

        $(document).on('click', '.status', function () {
            let order_id = $(this).data('id');

            $.ajax({
                url: "/order-status-paid", // куда отправляем
                type: "post", // метод передачи
                dataType: 'json',
                headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
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

        $(document).on('click', '#cancel_order', function () {
            let order_id = $(this).data('id');

            $.ajax({
                url: "/order-status-canceled", // куда отправляем
                type: "post", // метод передачи
                dataType: 'json',
                headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
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

        $(document).on('click', '#transit_order', function () {
            let order_id = $(this).data('id');

            $.ajax({
                url: "/order-status-transit", // куда отправляем
                type: "post", // метод передачи
                dataType: 'json',
                headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
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

        $(document).on('click', '#completed_order', function () {
            let order_id = $(this).data('id');

            $.ajax({
                url: "/order-status-completed", // куда отправляем
                type: "post", // метод передачи
                dataType: 'json',
                headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
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

        $('#print').on('click', function () {
            // let card = $('.card').clone();
            // card.find('.remove').remove();

        });

        $(document).on('click', '#chat', function () {

            let order_id = $(this).data('order');
            let role = $(this).data('role');

            function show() {

                $.ajax({
                    url: "/get-messages", // куда отправляем
                    type: "post", // метод передачи
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
                    data: {
                        'order_id' : order_id
                    },
                    // после получения ответа сервера
                    complete: function (mes) {
                        if (mes.status !== 200) {
                            alert("Ошибка");
                            return 0;
                        }
                        let messages = mes.responseJSON['messages'];
                        let org_id = mes.responseJSON['org_id'];
                        let customer_id = mes.responseJSON['user_id'];
                        let img = mes.responseJSON['imgPath'];

                        $('#chat-content').empty();

                        for(let i = 0; i < messages.length; i++) {

                            let add;

                            if (role === 'customer' ) {
                                if (messages[i].sender_id === customer_id) {
                                    add = ' <div class="media media-chat media-chat-reverse">'
                                        + '<div class="media-body">'
                                        + '<p>' + messages[i].message + '</p>'
                                        + '<p class="meta text-secondary"><time>' + new Date(messages[i].created_at).toLocaleString("ru", options) + '</time></p>'
                                        + '</div></div>';
                                }
                                else {
                                    add = '<div class="media media-chat"> <img class="avatar" src="' + img + '" alt="...">'
                                        + '<div class="media-body">'
                                        + '<p>' + messages[i].message + '</p>'
                                        + '<p class="meta"><time>' + new Date(messages[i].created_at).toLocaleString("ru", options) + '</time></p>'
                                        + '</div></div>';
                                }
                            }
                            else {

                                $('#org_img').attr("src", img);

                                if (messages[i].sender_id === org_id) {
                                    add = ' <div class="media media-chat media-chat-reverse">'
                                        + '<div class="media-body">'
                                        + '<p>' + messages[i].message + '</p>'
                                        + '<p class="meta text-secondary"><time>' + new Date(messages[i].created_at).toLocaleString("ru", options) + '</time></p>'
                                        + '</div></div>';
                                }
                                else {
                                    add = '<div class="media media-chat"> <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">'
                                        + '<div class="media-body">'
                                        + '<p>' + messages[i].message + '</p>'
                                        + '<p class="meta"><time>' + new Date(messages[i].created_at).toLocaleString("ru", options) + '</time></p>'
                                        + '</div></div>';
                                }
                            }
                            $('#chat-content').append(add);
                        }

                        $('#chat-content').scrollTop(document.getElementById('chat-content').scrollHeight - $('#chat-content').height());
                    }
                });
            }

            show();
            timerId = setInterval( function () {
                show();
            }, 10000);
        });



        $(document).on('click', '#send_message', function () {

            let message = $('.publisher-input').val();

            if(message === '')
                return 0;

            let order_id = $(this).data('order');
            let role = $(this).data('role');

            $.ajax({
                url: "/send-message", // куда отправляем
                type: "post", // метод передачи
                dataType: 'json',
                headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
                data: {
                    'order_id' : order_id,
                    'role' : role,
                    'message' : message
                },
                // после получения ответа сервера
                complete: function (mes) {
                    if (mes.status !== 200) {
                        alert("Ошибка");
                        return 0;
                    }

                    let add = ' <div class="media media-chat media-chat-reverse">'
                        + '<div class="media-body">'
                        + '<p>' + message + '</p>'
                        + '<p class="meta text-secondary"><time>' + new Date().toLocaleString("ru", options) + '</time></p>'
                        + '</div></div>';

                    $('#chat-content').append(add);

                    $('#chat-content').scrollTop(document.getElementById('chat-content').scrollHeight - $('#chat-content').height());

                    $('.publisher-input').val('');

                }
            });

        });
    })
</script>
