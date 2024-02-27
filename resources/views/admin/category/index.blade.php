@extends('layouts.admin')
@section('title', $viewData["title"])

@section('content')
    {{--<div class="card mb-4">
        <div class="card-header">Создать Категорию</div>
        <div class="card-body">
            @if($errors->any())
                <ul class="alert alert-danger list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-7">
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-md-6 col-sm-12 col-form-label">Наименование:</label>
                            <div class="col-lg-9 col-md-6 col-sm-12">
                                <input name="title" value="{{ old('title') }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-md-6 col-sm-12 col-form-label">Родитель:</label>
                            <div class="col-lg-9 col-md-6 col-sm-12">
                                <select class="form-select" name="parent_id">
                                    <option value="" @if(!old('parent_id')) selected="selected" @endif></option>
                                    @foreach ($viewData["categories"] as $category)
                                        <option value="{{$category->id}}"
                                                @if($category->id == old('parent_id')) selected="selected" @endif>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-md-6 col-sm-12 col-form-label">Фото:</label>
                            <div class="col-lg-9 col-md-6 col-sm-12">
                                <input class="form-control" type="file" name="photo">
                            </div>
                        </div>
                    </div>
                    <div class="col">&nbsp;</div>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>--}}
    <div class="card">
        <div class="card-header">Управление категорией</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Фото</th>
                    <th scope="col">Изменить</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($viewData["categories"] as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>
                            @if($category->photo)
                                <img class="img-mini" src="{{ asset('/storage/'.$category->photo) }}" alt="">
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.category.edit', ['id' => $category->id])}}">
                                <i class="bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach</tbody>
            </table>
        </div>
    </div>
@endsection
