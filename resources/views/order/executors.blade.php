<x-app-layout>
    @section('title', 'Исполнители')
    <div class="container my-5">
        <main role="main">

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
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="/organization/{{$org->id}}" class="btn btn-sm btn-outline-secondary">Просмотр</a>
                                            <a href="/executor/{{$org->id}}" class="btn btn-sm btn-outline-primary">Выбрать</a>
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
</x-app-layout>
