@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators mb-0">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="w-100 active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" class="w-100" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" class="w-100" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                {{--<svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">--}}<rect width="100%" height="100%" fill="#777"/></svg>
                <img src="{{asset('images/banner/mobile/novinki.jpg')}}" class="d-block w-100" alt="">
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1 class="text-center">Новинки</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('images/banner/mobile/verhnyaya.jpg')}}" class="d-block w-100" alt="">
                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="text-center">Пальто и тренчи</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('images/banner/mobile/dzhinsy.jpg')}}" class="d-block w-100" alt="">
                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1 class="text-center">Джинсы</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="d-flex justify-content-between m-3 mb-2">
            <h2 class="fs-7">Категории</h2>
            <div class="fs-7">Все <i class="bi bi-arrow-right-short"></i></div>
        </div>
        <div class="owl-carousel">
            @foreach($viewData['categories'] as $category)
                <div class="item">
                    <img src="{{ asset('/storage/'.$category->photo) }}" alt="">
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            center: true,
            items: 2,
            loop:true,
            margin:10,
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    </script>
@endpush
