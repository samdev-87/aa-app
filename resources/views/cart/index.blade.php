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
                    <form method="POST" action="{{ route('cart.purchase') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="full_name" class="col-3 col-form-label">ФИО <span>*</span></label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="" value="{{old('full_name')}}" required>
                                @error('full_name')
                                    <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-3 col-form-label">Телефон <span>*</span></label>
                            <div class="col-9">
                                <input type="text" class="phone form-control phone" name="phone" id="phone" placeholder="" required value="{{old('phone')}}">
                                @error('phone')
                                    <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <a href="#" class="btn btn-outline-secondary mb-2"><b>К оплате:</b> {{ $viewData['total'] }}</a>
                        @if (count($viewData["products"]) > 0)
                            <button type="submit" class="btn bg-primary text-white mb-2">Оформить</button>
                            {{--<a href="{{ route('cart.purchase') }}" >Оформить</a>--}}
                        <a class="btn btn-danger mb-2" href="{{ route('cart.delete') }}">
                            Удалить все продукты из корзины
                        </a>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
