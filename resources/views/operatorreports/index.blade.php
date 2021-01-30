@extends('layouts.operator')
@section('title', 'Отчеты')
@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Отчеты</h1>
        @include('operatorreports.filter')
    </div>
@endsection
