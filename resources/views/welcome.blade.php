
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Главная</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="\favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-5">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <img width="200px" src="/logo.svg" class="color">
        </div>
        <p class="text-white-50">3DPlace</p>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if (Route::has('login'))
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/profile') }}">Профиль</a>
                    </li>

            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Войти</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Регистрация</a></li>
                        @endif
                    @endauth
                </ul>
            @endif
        </div>
    </div>
</nav>
{{--@if (Route::has('login'))--}}
{{--    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">--}}
{{--        @auth--}}
{{--            <a href="{{ url('/profile') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Профиль</a>--}}
{{--        @else--}}
{{--            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Войти</a>--}}

{{--            @if (Route::has('register'))--}}
{{--                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Регистрация</a>--}}
{{--            @endif--}}
{{--        @endauth--}}
{{--    </div>--}}
{{--@endif--}}


<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <div class="text-center my-5">
                    <h1 class="display-5 fw-bolder text-white mb-2">Аддитивные технологии теперь доступны каждому</h1>
                    <p class="lead text-white-50 mb-4">Данный сервис является площадкой для размещения мощностей 3D печати и предоставлению услуг по взаимодействию с клиентами</p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{route('showPage')}}">Начать</a>
                        <a class="btn btn-outline-light btn-lg px-4" href="#features">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Features section-->
<section class="py-5 border-bottom" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class=" bg-primary bg-gradient text-white rounded-3 mb-3 w-25 h1 p-2 text-center">
                    <i class="bi bi-wallet-fill"></i>
                </div>
                <h2 class="h4 fw-bolder">Для бизнеса</h2>
                <p>Добавьте свою организацию, специализирующуюся на 3D печати на нашу площадку, размести описание и цены, и заказы не заставят себя ждать</p>
                <a class="text-decoration-none" href="{{route('orgs')}}">
                    Добавить организацию
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3 w-25 h1 p-2 text-center">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h2 class="h4 fw-bolder">Для физ лиц</h2>
                <p>Нужна 3D печать своей модели по адекватной цене? Все расчеты заказа сервис сделает за вас автомтаически! Просто загрузите модель и выберите сроки</p>
                <a class="text-decoration-none" href="{{route('showPage')}}">
                    Заказать
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-4">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3 w-25 h1 p-2 text-center">
                    <i class="bi bi-truck"></i>
                </div>
                <h2 class="h4 fw-bolder">Доставка и оплата</h2>
                <p>Кроме осуществления взаимодействия между пользователями, наш сервис также предоставляет свои услуги доставки в пункты выдачи, без посредников. Вы всегда будете знать, где сейчас ваш заказ.</p>
                <p>Оплата производится через сервис на рассчетный счет организации-исполнителя в течение недели после получения заказа. При отмене заказа все средства будут возвращены</p>

            </div>
        </div>
    </div>
</section>
<!-- Pricing section-->
<section class="bg-light py-5 border-bottom">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bolder">Цены</h2>
            <p class="lead mb-0">Разместите <b>цены</b> и <b>достижения</b> в профиле своей организации для улучшения конкурентоспособности</p>
        </div>
        <div class="row gx-5 justify-content-center">
            <!-- Pricing card free-->
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-5 mb-xl-0">
                    <div class="card-body p-5">
                        <div class="small text-uppercase fw-bold">PLA</div>
                        <div class="mb-3">
                            от <span class="display-4 fw-bold">{{$PLA}}р.</span>
                            <span class="text-muted">/ г.</span>
                        </div>
                        <p >Биоразлагаемый пластик, в основе которого находится молочная кислота. Производится из сахарного тростника или кукурузы.</p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Твердость (по Роквеллу) — R70-R90
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Прочность на изгиб — 55,3 МПа
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Прочность на разрыв — 57,8 МПа
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Плотность — 1,23-1,25 г/см³
                            </li>
                            <li class="mb-2 ">
                                <i class="bi bi-check text-primary"></i>
                                Точность печати — ± 0,1%
                            </li>
                            <li class="mb-2 ">
                                <i class="bi bi-check text-primary"></i>
                                Усадка при изготовлении изделий — нет
                            </li>
                            <li class="mb-2 ">
                                <i class="bi bi-check text-primary"></i>
                                Нетоксичен
                            </li>
                            <li class="mb-2 text-muted">
                                <i class="bi bi-x"></i>
                                Низкая температура размягчения (50°C)
                            </li>
                            <li class="mb-2 text-muted">
                                <i class="bi bi-x"></i>
                                Узкий температурный диапазон использования (-20 — +40°C)
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Pricing card pro-->
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-5 mb-xl-0">
                    <div class="card-body p-5">
                        <div class="small text-uppercase fw-bold">
                            ABS
                        </div>
                        <div class="mb-3">
                           от <span class="display-4 fw-bold">{{$ABS}}р.</span>
                            <span class="text-muted">/ г.</span>
                        </div>
                        <p>Ударопрочный пластик, очень популярен в промышленности и 3D-печати. Изделия из ABS достаточно прочны, поэтому его часто используют для печати функциональных объектов, имеющих практическое применение.</p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Твердость (по Роквеллу) — R105-R110
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Прочность на изгиб — 41 МПа
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Прочность на разрыв — 22 МПа
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Плотность — 1,1 г/см³
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Точность печати — ± 1%
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Усадка при изготовлении изделий — до 0,8%
                            </li>
                            <li class="text-muted">
                                <i class="bi bi-x"></i>
                                Желтеет на солнечном свете
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Pricing card enterprise-->
            <div class="col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="small text-uppercase fw-bold">Flex</div>
                        <div class="mb-3">
                           от <span class="display-4 fw-bold">{{$Flex}}р.</span>
                            <span class="text-muted">/ г.</span>
                        </div>
                        <p>Мягкий резиноподобный материал. Используется там, где нужна гибкость и эластичность готовых изделий.</p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Твердость (по Шору) — D40
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Прочность на изгиб — 5,3 МПа
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Прочность на разрыв — 17,5 МПа
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Плотность — 1,1 г/см³
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Точность печати — ± 1%
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Усадка при изготовлении изделий — 0,35-0,8%
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Гибкость
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                Масло-бензостойкость
                            </li>
                            <li class="text-muted">
                                <i class="bi bi-check text-primary"></i>
                                Сложность печати
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials section-->
<section class="py-5 border-bottom">
    <div class="container px-5 my-5 px-5">
        <div class="text-center mb-5">
            <h2 class="fw-bolder">Встроенный чат</h2>
            <p class="lead mb-0">В каждом заказе есть чат между заказчиком и организацией-исполнителем, где можно решить все нюансы</p>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <!-- Testimonial 1-->
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                            <div class="ms-4">
                                <p class="mb-1">Здравствуйте! Хочу уточнить детали заказа и поменять цвет.</p>
                                <div class="small text-muted">- Заказчик, 10:30</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2-->
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                            <div class="ms-4">
                                <p class="mb-1">Добрый вечер. Что именно вас интересует? Давайте обсудим детали!</p>
                                <div class="small text-muted">- Организация, 10:35</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact section-->
<section class="bg-light py-5">
    <div class="container px-5 my-5 px-5">
        <div class="text-center mb-5">
            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
            <h2 class="fw-bolder">Напишите нам!</h2>
            <p class="lead mb-0">Все замечания, пожелания принимаем по почте <a href="">service@3dplace.ru</a></p>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container px-5"><p class="m-0 text-center text-white">Все права защищены &copy; 3DPlace 2022</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>



