<x-app-layout>
    @section('title', 'Organization')
    <div class="container py-5">
        <div class="card pt-3">
            <img class="card-img-top w-25 align-self-center"
                 src="/storage/files/orgs/{{$org->id}}.jpg"
            >
            <div class="card-body">
                <h4 class="card-title text-center">{{$org->name}}</h4>
                <ul class="list-group my-2">
                    <li class="list-group-item">{{$org::TYPES[$org->type]}}</li>
                    <li class="list-group-item">Адрес: {{$org->jur_address}}</li>
                    <li class="list-group-item">ИНН: {{$org->inn}}</li>
                    <li class="list-group-item">КПП: {{$org->kpp}}</li>
                    <li class="list-group-item">ОГРН: {{$org->ogrn}}</li>
                    <li class="list-group-item">р/с: {{$org->payment_account}}</li>
                </ul>
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
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <a href="#!" class="btn btn-primary">Редактировать</a>
                        <a href="#!" class="btn btn-success">Заказы</a>
                    </div>
                    <a href="#!" class="btn btn-danger">Удалить</a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
