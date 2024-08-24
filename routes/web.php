<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('form');
});

Route::get('/', function () {
    return redirect('/form');
});


Route::get('/form', [FormController::class, 'showForm']);
Route::post('/form', [FormController::class, 'saveData'])->name('saveData');
Route::get('/getProvinces/{countryId}', [FormController::class, 'getProvinces']);
Route::get('/getDistricts/{provinceId}', [FormController::class, 'getDistricts']);