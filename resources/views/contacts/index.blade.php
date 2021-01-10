@extends('layouts.admin')
@section('title', 'Контакты')
@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Контакты</h1>

        {{--Загрузка--}}
        @include('contacts.upload')
        {{--Загрузка--}}

        @include('contacts.filter')





    </div>

@endsection
