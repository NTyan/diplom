<x-app-layout>
    @section('title', 'Orders')
    <div class="container my-5">
        <main role="main">

            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Мои заказы</h1>
                    <p class="lead text-muted">На этой странице вы можете посмотреть свои заказы</p>
                    <p>
                        <a href="#" class="btn btn-primary my-2">Создать заказ</a>
                        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                    </p>
                </div>
            </section>

            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">

                        @foreach($orders as $order)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <div class="card-body">
                                        <h4>Номер заказа: {{$order->number}}</h4>
                                        <dl>
                                            <dt>Дата: </dt>
                                            <dd>{{$order->create_at}}</dd>

                                            <dt>Сумма:</dt>
                                            <dd>{{$order->sum}}</dd>
                                        </dl>
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-outline-secondary" href="/orders/{{$order->id}}">Просмотр</a>
                                            </div>
                                            @switch($order->status)
                                                @case('processing')
                                                    <small class="text-primary">
                                                @break

                                                @case('canceled')
                                                    <small class="text-danger">
                                                @break

                                                @case('confirmed')
                                                    <small class="text-warning">
                                                @break

                                                @case('completed')
                                                    <small class="text-success">
                                                @break

                                                @case('transit')
                                                    <small class="text-info">
                                                @break

                                                @default
                                                    <small class="text-secondary">
                                            @endswitch
                                            {{$order->status}}</small>
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
</x-app-layout>
