<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Anna Anna')</title>
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @stack('styles')
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
</head>
<body>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="bd-links w-100" id="bd-docs-nav" aria-label="Docs navigation">
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item">Новинки</a>
                <a href="#" class="list-group-item">Покупателям</a>
                <a href="#" class="list-group-item">О компании</a>
                <a href="#" class="list-group-item">Магазин</a>
            </div>
        </nav>
    </div>
</div>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
            <div>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <a class="navbar-brand" href="/">Anna Anna</a>
            <a class="text-white d-md-none" href="{{ route('cart.index') }}"><i class="bi bi-bag"></i></a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</header>

<main>

    @yield('content')

    <!-- FOOTER -->
    <footer class="footer-border-top mt-3 fs-7">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 py-4">
                    <h4><a href="/">Anna Anna</a></h4>
                    <p>Одежда от казахстанского бренда ANNA ANNA: изыск в каждой детали.</p>
                    <p>Отбрось шаблоны, будь собой!</p>
                </div>
                <div class="col-12 col-md-3">
                    <h4>Покупателям</h4>
                    <div class="list-group">
                        <a class="list-group-item border-0" href="#">Доставка</a>
                        <a class="list-group-item border-0" href="#">Возврат</a>
                        <a class="list-group-item border-0" href="#">Вопросы и ответы</a>
                        <a class="list-group-item border-0" href="#">Отзывы</a>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <h4>О компании</h4>
                    <div class="list-group">
                        <a class="list-group-item border-0" href="#">История</a>
                        <a class="list-group-item border-0" href="#">Карьера</a>
                        <a class="list-group-item border-0" href="#">Контакты</a>
                    </div>
                </div>
            </div>
            <div class="py-4 footer-border-top">
                <a class="me-3" href="https://www.youtube.com/@annaanna_official">YouTube</a>
                <a class="me-3" href="https://www.instagram.com/annaanna_official">Instagram</a>
            </div>
            <div class="d-flex justify-content-between align-items-center footer__bottom footer-border-top">
                <div>© 2024 Anna Anna</div> {{---Все права защищены.--}}
                <div><a href="#">Наверх</a></div>
            </div>
        </div>
    </footer>
</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
@stack('scripts')
<script>
    $(document).ready(function() {
        var scroll_pos = 0;
        $(document).scroll(function() {
            scroll_pos = $(this).scrollTop();
            if(scroll_pos > 300) {
                $("nav").css('background-color', 'white');
                $('.navbar-brand').css('color', "rgb(79, 62, 53)")
                $('.bi-bag').css('color', "rgb(79, 62, 53)")
            } else {
                $("nav").css('background-color', 'inherit');
                $('.navbar-brand').css('color', "#fff")
                $('.bi-bag').css('color', "#fff")
            }
        });
    });
</script>
</body>
</html>
