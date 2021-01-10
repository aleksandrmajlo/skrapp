@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">СТАТИСТИКА РАБОТЫ ОПЕРАТОРОВ</div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Отправлено</th>
                                    <th scope="col">Открыто</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">СТАТИСТИКА КОНТАКТЫ</div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Импортировано</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
