<x-app-layout>
    @section('title', 'Business')
    <div class="container my-5">
        <main role="main">

            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Мои организации</h1>
                    <p class="lead text-muted">На этой странице вы можете добавить организации, специализирующиеся на 3д печати, владельцем которых являетесь.</p>
                    <p>
                        <a href="#" class="btn btn-primary my-2">Добавить новую организацию</a>
                        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
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
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="/organization/{{$org->id}}" class="btn btn-sm btn-outline-secondary">Просмотр</a>
                                            <a href="/org-orders/{{$org->id}}" class="btn btn-sm btn-outline-secondary">Заказы</a>
                                        </div>
                                        <small class="text-muted">Рейтинг</small>
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
