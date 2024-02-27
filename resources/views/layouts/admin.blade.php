<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
    <title>@yield('title', 'Admin - Anna Anna')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet"/>
</head>
<body>

<div class="row g-0">
    <!-- sidebar -->
    <div class="p-3 col fixed text-white bg-dark">
        <a href="{{ route('admin.home.index') }}" class="text-white text-decoration-none"><span
                class="fs-4">Admin Panel</span></a>
        <hr/>
        <ul class="nav flex-column">
            <li><a href="{{ route('admin.home.index') }}" class="nav-link text-white">- Главная</a></li>
            <li><a href="{{route('admin.category.index')}}" class="nav-link text-white">- Категории</a></li>
            <li><a href="{{route('admin.product.index')}}" class="nav-link text-white">- Товары</a></li>
            <li><a href="{{ route('home.index') }}" class="mt-2 btn bg-primary text-white">Вернуться на домашнюю страницу</a>
            </li>
        </ul>
    </div>
    <!-- sidebar -->

    <div class="col content-grey">
        <nav class="p-3 shadow text-end">
            <span class="profile-font">Admin</span>
            <img class="img-profile rounded-circle" src="{{ asset('/images/undraw_profile.svg') }}">
        </nav>
        <div class="g-0 m-5">
            @yield('content')
        </div>
    </div>
</div>

<!-- footer -->
<div class="copyright py-4 text-center text-white">
    <div class="container">
        <small> Copyright - <a class="text-reset fw-bold text-decoration-none" target="_blank"
                               href="https://samdev.kz"> SamDev.kz </a> </small>
    </div>
</div>
<!-- footer -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
