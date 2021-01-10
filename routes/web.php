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
    Route::resource('reports', App\Http\Controllers\Admin\ReportController::class);
    // настройки
    Route::resource('settings', App\Http\Controllers\Admin\SettingController::class);

    // загрузка exel
    Route::post('file-upload', [App\Http\Controllers\Admin\FileUploadController::class, 'fileUploadExcel'])->name('file.upload.excel');

});

Route::group(['middleware' => 'roleoperator'], function () {

    Route::get('/dashboardoperator', [App\Http\Controllers\HomeController::class, 'operator'])->name('dashboardoperator');

});


