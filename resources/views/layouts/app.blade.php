<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="pb-1 bg-gray-100">
{{--    <div class="min-h-screen bg-gray-100">--}}
            @include('layouts.navigation')

{{--            <!-- Page Heading -->--}}
{{--            <header class="bg-white shadow">--}}
{{--                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                    {{ $header }}--}}
{{--                </div>--}}
{{--            </header>--}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <!-- Footer -->
        <div class="container">
            <footer class="row row-cols-5 py-5 my-5 border-top">
                <div class="col">
                    <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    </a>
                    <p class="text-muted">3DPlace ?? 2022</p>
                </div>

                <div class="col">

                </div>

                <div class="col">
                    <h5>??????????????????</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="{{route('home')}}" class="nav-link p-0 text-muted">??????????????</a></li>
                        <li class="nav-item mb-2"><a href="{{route('showPage')}}" class="nav-link p-0 text-muted">?????????????? ??????????</a></li>
                        <li class="nav-item mb-2"><a href="{{route('orders')}}" class="nav-link p-0 text-muted">?????? ????????????</a></li>
                        <li class="nav-item mb-2"><a href="{{route('orgs')}}" class="nav-link p-0 text-muted">?????? ??????????????????????</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted" data-toggle="modal" data-target=".modal-info">?? ??????????????</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h5>????????????????</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">Email: <a href="#" class="nav-link p-0 text-muted">service@3dplace.ru</a></li>
                        <li class="nav-item mb-2">??????????????????: <a href="#" class="nav-link p-0 text-muted">t.me/3dplace</a></li>
                    </ul>
                </div>
            </footer>
        </div>
    </body>

    {{-- ?????????????????? ????????  --}}
    <div class="modal fade modal-info " id="modal_hide" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-3 text-center">
                <p>???????????? ???????????????????? ?? ???????????? ?????????????????? ???????????????????????????????? ????????????</p>
                <p>?????????????????? ???????????? 18????????1</p>
                <p>?????????????????? ??????????</p>
            </div>
        </div>

    </div>

</html>
<script>

</script>
