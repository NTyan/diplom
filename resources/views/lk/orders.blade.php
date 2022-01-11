<x-app-layout>
    @section('title', 'Заказы')
    <div class="container my-5">
        <main role="main">

            <section class="jumbotron text-center">
                <div class="container">
                    @isset($org)
                        <h1 class="jumbotron-heading">Заказы {{$org->name}}</h1>
                        <p class="lead text-muted">На этой странице вы можете посмотреть заказы своей организации</p>
                    @endisset
                    @empty($org)
                        <h1 class="jumbotron-heading">Мои заказы</h1>
                        <p class="lead text-muted">На этой странице вы можете посмотреть свои заказы</p>
                        <p>
                            <a href="{{url('/show-page')}}" class="btn btn-primary my-2">Создать заказ</a>
                        </p>
                    @endempty
                </div>
            </section>

            <table class="table table-hover table_sort" >
                <thead class="thead-dark cursor-pointer">
                <tr>
                    <th>#</th>
                    <th>Номер заказа</th>
                    <th>Статус</th>
                    <th>Дата и время</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $key => $order)
                        <tr>
                            <th scope="row">{{$key +1}}</th>
                            <td>
                                <a class="btn btn-outline-dark" href="{{url('/orders/' . $order->id)}}">
                                {{$order->number}}
                                </a>
                            </td>
                            <td>
                                @isset($order->status)
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
                                            {{App\Models\Order::STATUS[$order->status]}}</span>
                                        @endisset
                            </td>
                            <td>{{$order->created_at->format('d.m.y в G:i')}}</td>
                            <td>
                                @if($order->is_paid)
                                    <i class="bi bi-credit-card-2-front-fill text-success"></i>
                                @else
                                    <i class="bi bi-credit-card-2-front-fill text-danger"></i>
                                @endif
                                {{number_format($order->sum)}}р.
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </main>
    </div>
</x-app-layout>

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
