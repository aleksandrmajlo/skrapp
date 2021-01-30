<div class="row my-5">
    <div class="col-md-12">
        <h2 class="mb-3">СФОРМИРОВАТЬ ОТЧЁТ</h2>
    </div>
    <div class="col-md-12">
        <form class="form-inline" method="get">
            <div class="form-group mx-sm-3 mb-2">
                <label  class="pr-2 font-weight-bold" >Начало</label>
                <input required type="date" name="start" class="form-control">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label  class="pr-2 font-weight-bold" >Конец</label>
                <input required type="date" name="end" class="form-control">
            </div>

            <div class="form-group mx-sm-3 mb-2">
                <select name="operator" required class="form-control">
                    <option selected>Выбрать оператора</option>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <select name="status" required class="form-control">
                    <option selected>Статус анкет</option>
                </select>
            </div>
            @foreach($banks as $bank)
                <div class="form-group form-check mx-sm-3 mb-2">
                    <input type="checkbox" required name="banks[]" class="form-check-input" id="bank{{$bank->id}}">
                    <label class="form-check-label font-weight-bold" for="bank{{$bank->id}}">{{$bank->name}}</label>
                </div>
            @endforeach
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
