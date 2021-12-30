<x-app-layout>
    @section('title', 'Order')
    <div class="container py-5">
        <div class="card ">
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
                @if($role === "customer")
                <a href="#" class="btn btn-danger">Отменить</a>
                @endif
            </div>
            <ul class="list-group list-group-flush">
                @foreach($models as $key => $model)
                    <li class="list-group-item">
                        <div class="p-2 flex-fill"><b>Название:</b> {{$model->title}}</div>
                        <table class="table table-hover table-info">
                            <tbody>
                            <tr>
                                <th scope="row">{{$key +1}}</th>
                                <td>
                                    <dt>Размеры</dt>
                                    <dd>{{$model->width}}х{{$model->height}}х{{$model->length}}</dd>

                                    <dt>Объем</dt>
                                    <dd>{{$model->volume}}</dd>

                                    <dt>Вес</dt>
                                    <dd>{{$model->weight}}</dd>
                                </td>
                                <td>
                                    <dt>Цвет</dt>
                                    <dd>{{$model->color}}</dd>
                                </td>
                                <td>
                                    <dt>Пластик</dt>
                                    <dd>{{$model->plastic}}</dd>
                                </td>
                                <td>
                                    <dt>Количество</dt>
                                    <dd>{{$model->count}}</dd>
                                </td>
                                <td>
                                    <dt>Цена</dt>
                                    <dd> {{$model->price}}</dd>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </li>
                @endforeach
                <li class="list-group-item font-weight-bold">
                    <div class="d-flex flex-row">
                        <div>
                            Сумма: {{$order->sum}} р.
                            @if(!$order->is_paid && $role === "customer")
                                <a href="#" class="card-link">Оплатить</a>
                            @elseif(!$order->is_paid && $role === "executor")
                                <p class="text-danger">Неоплачено</p>
                            @else
                                <p class="text-success">Оплачено</p>
                            @endif
                        </div>
                    @if($role === "executor" && $order->status === "processing")
                        <div class="ml-2 align-self-center">
                            <a href="#" class="btn btn-sm btn-info status" data-id="{{$order->id}}">Подтвердить оплату</a>
                        </div>
                    @endif
                    </div>
                </li>
                @if($order->date_of_receiving)
                <li class="list-group-item ">
                   <b> Желаемая дата получения: </b>{{$order->date_of_receiving}}
                </li>
                @endif
                @if($order->comment)
                <li class="list-group-item ">
                   <b> Комментарий: </b> {{$order->comment}}
                </li>
                @endif
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Распечатать</a>
                <a href="#" class=" btn btn-primary">Чат с {{ $name }}</a>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function () {
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
    })
</script>
