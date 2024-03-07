@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/storage/'.$viewData["product"]->photo) }}" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="text-center">
                        <p class="mb-1 bd-color">{{ $viewData['product']->category->title }}</p>
                        <h5 class="card-title">
                            {{ $viewData["product"]->title }}
                        </h5>
                        <p>{{ $viewData["product"]->price }} тг.</p>
                    </div>
                    <p class="card-text">
                    <form method="POST" class="form-inline" action="{{ route('cart.add', ['id'=> $viewData['product']->id]) }}">
                        @csrf
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-text">Цвет:</div>
                                <select name="color" class="form-select">
                                    @foreach(explode(',', $viewData['product']->colors) as $color)
                                        @if ($loop->first)
                                            <option value="{{$color}}" selected="selected">{{$color}}</option>
                                        @else
                                            <option value="{{$color}}">{{$color}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-text">Размер:</div>
                                <select name="size" class="form-select">
                                    @foreach(explode(',', $viewData['product']->sizes) as $size)
                                        @if ($loop->first)
                                            <option value="{{$size}}" selected="selected">{{$size}}</option>
                                        @else
                                            <option value="{{$size}}">{{$size}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <button class="btn bg-primary text-white" type="submit">Добавить в корзину</button>
                        </div>
                    </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
