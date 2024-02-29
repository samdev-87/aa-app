@extends('layouts.admin')
@section('title', $viewData["title"])

@section('content')
    <div class="card">
        <div class="card-header">Управление товаром</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Фото</th>
                    <th scope="col">Изменить</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($viewData["products"] as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->category === null ? '' : $product->category->title }}</td>
                        <td>
                            @if($product->photo)
                                <img class="img-mini" src="{{ asset('/storage/'.$product->photo) }}" alt="">
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.product.edit', ['id' => $product->id])}}">
                                <i class="bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $viewData['products']->links() }}
        </div>
    </div>
@endsection
