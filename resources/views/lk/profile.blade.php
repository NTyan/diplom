<x-app-layout>
    @section('title', 'Profile')
    <div class="container my-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{Auth::user()->name}}</h4>
                <h6 class="card-subtitle mb-2 text-muted">{{Auth::user()->email}}</h6>
                <a href="#!" class="card-link">Сменить пароль</a>
                <a href="#!" class="card-link">Удалить аккаунт</a>
            </div>
        </div>
        <div class="d-flex justify-content-between my-5">
            <a href="{{ route('orders') }}" class="btn w-100 p-0 mr-3">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Мои заказы</h4>
                    </div>
                </div>
            </a>
            <a href="{{ route('orgs') }}" class="btn w-100 p-0 ml-3">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Для бизнеса</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
