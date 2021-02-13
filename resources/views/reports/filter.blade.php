<div class="row my-5">
    <div class="col-md-12">
        <h2 class="mb-3">СФОРМИРОВАТЬ ОТЧЁТ</h2>
    </div>
    <div class="col-md-12">
        <form class="form-inline" action="/reports-filter" method="get">
            <div class="form-group mx-sm-3 mb-2">
                <label class="pr-2 font-weight-bold">Начало</label>
                <input type="date" value="{{\Request()->get('date_start')}}" name="date_start" class="form-control">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="pr-2 font-weight-bold">Конец</label>
                <input type="date" name="date_end" value="{{\Request()->get('date_end')}}"  class="form-control">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <select name="user_id" class="form-control">
                    <option value="" disabled selected>Выбрать оператора</option>
                    @if($operators)
                        @foreach($operators as $operator)
                            <option
                                @if((int)\Request()->get('user_id')==$operator->id)
                                    selected="selected"
                                @endif
                                value="{{$operator->id}}">
                                {{$operator->fio}}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <select name="status" class="form-control">
                    <option value="" disabled selected>Статус анкет</option>
                    @if($status)
                        @foreach($status as $key=>$item)
                            <option
                                @if(!is_null(\Request()->get('status'))&&\Request()->get('status')==$key)
                                   selected="selected"
                                @endif
                                value="{{$key}}">{{$item}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            @foreach($banks as $bank)
                <div class="form-group form-check mx-sm-3 mb-2">
                    <input type="radio"
                           @if(\Request()->get('bank_id')==$bank->id)
                             checked
                           @endif
                           value="{{$bank->id}}"
                           name="bank_id" class="form-check-input" id="bank{{$bank->id}}">
                    <label class="form-check-label font-weight-bold" for="bank{{$bank->id}}">{{$bank->name}}</label>
                </div>
            @endforeach
            @if(Route::is('reports-filter'))
                <a class="btn btn-outline-info mr-4" href="/reports">Очистить</a>
            @endif
            <button type="submit" class="btn btn-primary mb-2">Сформировать отчет</button>
        </form>
    </div>
    <div class="col-md-12">
        <h3 class="my-3">РЕЗУЛЬТАТ ОТЧЁТА:</h3>
    </div>
    <div class="col-md-12">
        <hr class="new1">
    </div>
</div>
