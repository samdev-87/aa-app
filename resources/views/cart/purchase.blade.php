@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="card">
        <div class="card-header">Purchase Completed</div>
        <div class="card-body">
            <div class="alert alert-success" role="alert">
                Поздравляем, покупка завершена. Номер заказа <b>#{{ $viewData["order"]->getId() }}</b>
            </div>
        </div>
    </div>
@endsection
