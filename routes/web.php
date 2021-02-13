<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/no-access', function () {
    return view('no-access');
});
Auth::routes(['register' => false]);

Route::group(['middleware' => 'roleadmin'], function () {

    Route::get('/dashboardadmin', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboardadmin');
    //операторы
    Route::resource('operators', App\Http\Controllers\Admin\OperatorController::class);
    // контакты
    Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class);
    // отчеты
    Route::get('reports-filter', 'App\Http\Controllers\Admin\ReportController@filter')->name('reports-filter');
    Route::resource('reports', App\Http\Controllers\Admin\ReportController::class);
    // настройки
    Route::resource('settings', App\Http\Controllers\Admin\SettingController::class);


});
// оператор
Route::group(['middleware' => 'roleoperator'], function () {
    Route::get('/dashboardoperator', [App\Http\Controllers\HomeController::class, 'operator'])->name('dashboardoperator');
    // отчеты
    Route::get('reports-filter-operator', 'App\Http\Controllers\Operator\ReportController@filter')->name('reports-filter-operator');
    Route::resource('operatorreports', App\Http\Controllers\Operator\ReportController::class);
    // контакты
    Route::get('operatorcontacts/search', 'App\Http\Controllers\Operator\ContactController@search')->name('search_operatorcontacts');
    Route::resource('operatorcontacts', App\Http\Controllers\Operator\ContactController::class);
});
// загрузка exel контактов
Route::post('file-upload', [App\Http\Controllers\Admin\FileUploadController::class, 'fileUploadExcel'])->name('file.upload.excel');
Route::group(['prefix' => 'ajax'], function () {
    Route::post('/operators/authenticationlogs', 'App\Http\Controllers\Api\OperatorController@logs');
    // разрешение для операторов  для работы  с банками
    Route::post('/settings/shippingpermission', 'App\Http\Controllers\Api\ShippingController@permission');
    Route::post('/settings/shippingpermission_send', 'App\Http\Controllers\Api\ShippingController@permission_send');
    Route::post('/settings/setting', 'App\Http\Controllers\Api\ShippingController@setting');
    Route::post('/settings/setting_send', 'App\Http\Controllers\Api\ShippingController@setting_send');
    // для работы с контактами
    Route::post('/contacts/update', 'App\Http\Controllers\Api\ContactAjax@update');
    Route::post('/contacts/log', 'App\Http\Controllers\Api\ContactAjax@log');

    Route::post('/contact/sendBankContac', 'App\Http\Controllers\Api\ContactAjax@sendBankContac');

});
// тестовый удалить!!!!!!!!!!!!!!
Route::get('test','App\Http\Controllers\TestController@index2');
