@extends('layouts.admin')
@section('title', 'Добавить оператора')
@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Добавить оператора</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('operators.store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">ФИО</label>
                        <div class="col-sm-10">
                            <input required type="text"  name="fio" class="form-control"  placeholder="Иванов Иван Иванович" value="{{ old('fio') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input required type="email"  name="email" class="form-control" placeholder="email@example.com" value="{{ old('email') }}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="inputPassword" required placeholder="Password" value="{{ old('password') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">OperatorStatus</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status" required>
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">ContactUpload</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="upload" id="gridRadios1" value="1" required checked>
                                    <label class="form-check-label" for="gridRadios1">
                                       Да
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="upload" required id="gridRadios2" value="0">
                                    <label class="form-check-label" for="gridRadios2">
                                       Нет
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
