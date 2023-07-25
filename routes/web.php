<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
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



Auth::routes();

//Dashboard
Route::get('/',[HomeController::class,'index']);
// Route::get('/dashboard',[HomeController::class,'index']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/incomes',IncomeController::class);

Route::get('incomes-filter',[IncomeController::class,'filter'])->name('incomes.filter');

// Route::get('/incomes', [IncomeController::class, 'index'])->name('incomes.index');
Route::get('/incomes-create', [IncomeController::class, 'create'])->name('incomes.create');
// Route::post('/incomes-store', [IncomeController::class, 'store'])->name('incomes.store');
// Route::get('/incomes-edit', [IncomeController::class, 'edit'])->name('incomes.edit');
// Route::post('/incomes/update', [IncomeController::class, 'update'])->name('incomes.update');
// Route::delete('/incomes/destroy/', [IncomeController::class, 'destroy'])->name('incomes.destroy');


Route::resource('/expenses',ExpenseController::class);

Route::get('/expenses-create', [ExpenseController::class, 'create'])->name('expenses.create');
Route::get('expense-filter',[ExpenseController::class,'filter'])->name('expenses.filter');