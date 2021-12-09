<x-app-layout>
    @section('title', 'Order')
    <div class="container py-5">
        <div class="card ">
            <div class="card-body d-flex justify-content-between">
                <h5 class="card-title">Заказ {{$order->number}}</h5>
                <a href="#" class="btn btn-danger">Отменить</a>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($models as $model)
                    <li class="list-group-item">
                        <div class="d-flex">
                            <div class="flex-column flex-fill">
                                <div class="p-2">
                                    <div class="p-2 font-weight-bold d-inline-flex">Размеры</div>
                                    <div class="p-2 d-inline-flex">{{$model->width}}х{{$model->height}}</div>
                                </div>
                                <div class="p-2">
                                    <div class="p-2 font-weight-bold d-inline-flex">Объем</div>
                                    <div class="p-2 d-inline-flex">{{$model->volume}}</div>
                                </div>
                                <div class="p-2">
                                    <div class="p-2 font-weight-bold d-inline-flex">Вес </div>
                                    <div class="p-2 d-inline-flex">{{$model->weight}}</div>
                                </div>
                            </div>
                            <div class="p-2 flex-fill"><p class="font-weight-bold">Цвет </p>{{$model->color}}</div>
                            <div class="p-2 flex-fill"><p class="font-weight-bold">Пластик </p>{{$model->plastic}}</div>
                            <div class="p-2 flex-fill"><p class="font-weight-bold">Количество </p>{{$model->count}}</div>
                            <div class="p-2 flex-fill"><p class="font-weight-bold">Цена </p>{{$model->price}}</div>
                        </div>
                    </li>
                @endforeach
                <li class="list-group-item">
                    Сумма: {{$order->sum}}
                    @if(!$order->is_paid)
                        <a href="#" class="card-link">Оплатить</a>
                    @else
                        <p class="text-success">Оплачено</p>
                    @endif
                </li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Распечатать</a>
                <a href="#" class=" btn btn-primary">Чат с {{ $org->name }}</a>
            </div>
        </div>
    </div>
</x-app-layout>
