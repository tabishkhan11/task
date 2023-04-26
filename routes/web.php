<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;

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

Route::resource('employees', EmployeeController::class);

Route::get('employees', [EmployeeController::class, 'index'])->name('index');
Route::post('employees/store', [EmployeeController::class, 'index'])->name('store');
Route::post('employees', [EmployeeController::class, 'show'])->name('show');
Route::delete('employees/{id}', [EmployeeController::class, 'destroy'])->name('delete');
Route::post('employees/{id}',[EmployeeController::class, 'edit'])->name('edit');
Route::post('employees/update/{id}', [EmployeeController::class, 'update'])->name('update');

