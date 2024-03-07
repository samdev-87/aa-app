@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="card">
        <div class="card-header">
            Товары в Корзине
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th class="w-50" scope="col">Фото</th>
                    <th scope="col">
                        <div>Название</div>
                        <div>Цена</div>
                        <div>Цвет</div>
                        <div>Размер</div>
                    </th>
                </tr>
                </thead>
                <tbody>
                    @foreach($viewData['products'] as $product)
                        <tr>
                            <td><img src="{{ asset('/storage/'.$product->photo) }}" class="img-fluid rounded-start"></td>
                            <td>
                                <div>{{ $product->title }}</div>
                                <div>{{ $product->price }}</div>
                                <div>{{ session('products')[$product->id]['color'] }}</div>
                                <div>{{ session('products')[$product->id]['size'] }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="text-end">
                    <a href="#" class="btn btn-outline-secondary mb-2"><b>К оплате:</b> {{ $viewData['total'] }}</a>
                    @if (count($viewData["products"]) > 0)
                    <a href="{{ route('cart.purchase') }}" class="btn bg-primary text-white mb-2">Оформить</a>
                    <a href="{{ route('cart.delete') }}">
                        <button class="btn btn-danger mb-2">
                            Удалить все продукты из корзины
                        </button>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
