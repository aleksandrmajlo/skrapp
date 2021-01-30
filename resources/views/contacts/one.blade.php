<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col"></th>
            <th scope="col">СВЕДЕНИЯ</th>
            <th scope="col">БАНК</th>
            <th scope="col">СТАТУС</th>
            <th scope="col">CityCode</th>
            <th scope="col">ProductCode</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>ID</td>
            <td>{{$contact->idbank}}</td>
            <td>{{$banks[0]->name}}</td>
            <td>
                <!--
                [0 — НЕТ в системе] /
                [1 — Есть в системе] /
                [2 — Анкета отправлена]  /
                [ 3 — Счёт открыт ]
                + [ДАТА присвоения статуса]
                -->
            </td>
            <td>
                <select name="city">
                    <option>Выбирите город</option>
                </select>
            </td>
            <td>
                <select>
                    <option>Тип продукта</option>
                </select>
            </td>
            <td>
                <button disabled class="btn btn-default">ОТПРАВИТЬ</button>
            </td>
        </tr>
        <tr>
            <td>INN</td>
            <td>
                <div class="realData"><span>{{$contact->inn}}</span>
                    <a class="changeLink" href="#"><i class="fab fa-stack-exchange"></i></a>
                </div>
                <div class="resetData   align-items-center justify-content-between d-none">
                    <input class="form-control dataInp" type="text" data-orig="{{$contact->inn}}" value="{{$contact->inn}}" name="inn">
                    <a class="resetLink" href="#"><i class="far fa-window-close"></i></a>
                </div>
            </td>
            <td>{{$banks[1]->name}}</td>
            <td>
                <!--
                [0 — НЕТ в системе] /
                [1 — Есть в системе] /
                [2 — Анкета отправлена]  /
                [ 3 — Счёт открыт ]
                + [ДАТА присвоения статуса]
                -->
            </td>
            <td>
                <select name="city">
                    <option>Выбирите город</option>
                    @if($banks[1]->cities)
                        @foreach($banks[1]->cities as $city)
                            <option value="{{$city->idd}}">{{$city->title}}</option>
                        @endforeach
                    @endif
                </select>
            </td>
            <td>
                <select name="tariff">
                    <option>Тип продукта</option>
                    @if($banks[1]->tariffs)
                        @foreach($banks[1]->tariffs as $tariff)
                            <option value="{{$tariff->idd}}">{{$tariff->title}}</option>
                        @endforeach
                    @endif
                </select>
            </td>
            <td>
                <button disabled class="btn btn-default">ОТПРАВИТЬ</button>
            </td>
        </tr>
        <tr>
            <td>ORGANIZATION</td>
            <td>

                <div class="realData"><span>{{$contact->organization}}</span>
                    <a class="changeLink" href="#"><i class="fab fa-stack-exchange"></i></a>
                </div>
                <div class="resetData   align-items-center justify-content-between d-none">
                    <textarea class="form-control dataInp" type="text" data-orig="{{$contact->organization}}" value="{{$contact->organization}}" name="organization">{{$contact->organization}}</textarea>
                    <a class="resetLink" href="#"><i class="far fa-window-close"></i></a>
                </div>
            </td>
            <td>{{$banks[2]->name}}</td>
            <td>
                <!--
                [0 — НЕТ в системе] /
                [1 — Есть в системе] /
                [2 — Анкета отправлена]  /
                [ 3 — Счёт открыт ]
                + [ДАТА присвоения статуса]
                -->
            </td>
            <td>
                <select name="city">
                    <option>Выбирите город</option>
                </select>
            </td>
            <td>
                <select name="tariff">
                    <option>Тип продукта</option>
                </select>
            </td>
            <td>
                <button disabled class="btn btn-default">ОТПРАВИТЬ</button>
            </td>
        </tr>
        <tr>
            <td>FULLNAME</td>
            <td>

                <div class="realData"><span> {{$contact->fullname}}</span>
                    <a class="changeLink" href="#"><i class="fab fa-stack-exchange"></i></a>
                </div>
                <div class="resetData   align-items-center justify-content-between d-none">
                    <textarea class="form-control dataInp" type="text" data-orig="{{$contact->fullname}}" value="{{$contact->fullname}}" name="fullname">{{$contact->fullname}}</textarea>
                    <a class="resetLink" href="#"><i class="far fa-window-close"></i></a>
                </div>

            </td>
            <td>{{$banks[3]->name}}</td>
            <td>
                <!--
                [0 — НЕТ в системе] /
                [1 — Есть в системе] /
                [2 — Анкета отправлена]  /
                [ 3 — Счёт открыт ]
                + [ДАТА присвоения статуса]
                -->
            </td>
            <td>
                <select name="">
                    <option>Выбирите город</option>
                </select>
            </td>
            <td>
                <select>
                    <option>Тип продукта</option>
                </select>
            </td>
            <td>
                <button disabled class="btn btn-default">ОТПРАВИТЬ</button>
            </td>
        </tr>

        <tr>
            <td>PHONE</td>
            <td>
                <div class="realData"><span>{{$contact->phone}}</span>
                    <a class="changeLink" href="#"><i class="fab fa-stack-exchange"></i></a>
                </div>
                <div class="resetData   align-items-center justify-content-between d-none">
                    <input class="form-control dataInp" type="tel" data-orig="{{$contact->phone}}" value="{{$contact->phone}}" name="phone">
                    <a class="resetLink" href="#"><i class="far fa-window-close"></i></a>
                </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>EMAIL</td>
            <td>
                <div class="realData"><span>{{$contact->email}}</span>
                    <a class="changeLink" href="#"><i class="fab fa-stack-exchange"></i></a>
                </div>
                <div class="resetData   align-items-center justify-content-between d-none">
                    <input class="form-control dataInp" type="email" data-orig="{{$contact->email}}" value="{{$contact->email}}" name="email">
                    <a class="resetLink" href="#"><i class="far fa-window-close"></i></a>
                </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>ADDRESS</td>
            <td>
                <div class="realData"><span>{{$contact->address}}</span>
                    <a class="changeLink" href="#"><i class="fab fa-stack-exchange"></i></a>
                </div>
                <div class="resetData   align-items-center justify-content-between d-none">
                    <textarea class="form-control dataInp" type="text" data-orig="{{$contact->address}}" value="{{$contact->address}}" name="address">{{$contact->address}}</textarea>
                    <a class="resetLink" href="#"><i class="far fa-window-close"></i></a>
                </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        </tbody>
    </table>
</div>
<button disabled id="saveClient" class="btn btn-primary ">Сохранить измененные данные контакта</button>
