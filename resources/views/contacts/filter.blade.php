<div class="row my-5">
    <div class="col-md-12">
        <h2 class="mb-3">Фильтр контактов</h2>
    </div>
    <div class="col-md-12">
        <form class="form-inline" method="get">

            <div class="form-group mx-sm-3 mb-2">
                <label  class="pr-2 font-weight-bold" >Начало</label>
                <input type="date" name="start" class="form-control">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label  class="pr-2 font-weight-bold" >Конец</label>
                <input type="date" name="end" class="form-control">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="pr-2 font-weight-bold" >ДУБЛИ ПРОВЕРКА</label>
                <select name="double" class="form-control">
                   <option value="all">ВСЕ</option>
                   <option value="-1">НЕТ</option>
                   <option value="1">ДА</option>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label  class="pr-2 font-weight-bold" >АЛЬФА</label>
                <select name="alfa" class="form-control">
                   <option value="-1">НЕТ В СИСТЕМЕ</option>
                   <option value="1">ЕСТЬ В СИСТЕМЕ</option>
                   <option value="2">АНКЕТА ОТПРАВЛЕНА</option>
                   <option value="3">СЧЁТ ОТКРЫТ</option>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="pr-2 font-weight-bold" >ОТКРЫТИЕ</label>
                <select name="alfa" class="form-control">
                   <option value="-1">НЕТ В СИСТЕМЕ</option>
                   <option value="1">ЕСТЬ В СИСТЕМЕ</option>
                   <option value="2">АНКЕТА ОТПРАВЛЕНА</option>
                   <option value="3">СЧЁТ ОТКРЫТ</option>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="pr-2 font-weight-bold" >ТИНЬКОФФ </label>
                <select name="alfa" class="form-control">
                   <option value="-1">НЕТ В СИСТЕМЕ</option>
                   <option value="1">ЕСТЬ В СИСТЕМЕ</option>
                   <option value="2">АНКЕТА ОТПРАВЛЕНА</option>
                   <option value="3">СЧЁТ ОТКРЫТ</option>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="pr-2 font-weight-bold" >ВТБ </label>
                <select name="alfa" class="form-control">
                   <option value="-1">НЕТ В СИСТЕМЕ</option>
                   <option value="1">ЕСТЬ В СИСТЕМЕ</option>
                   <option value="2">АНКЕТА ОТПРАВЛЕНА</option>
                   <option value="3">СЧЁТ ОТКРЫТ</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Применить</button>
        </form>
    </div>
    <div class="col-md-12">
         <h3 class="my-3">РЕЗУЛЬТАТ ПАРАМЕТРОВ ФИЛЬТРА:</h3>
    </div>
    <div class="col-md-12">
        <hr class="new1">
    </div>
</div>
