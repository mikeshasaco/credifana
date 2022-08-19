<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/formHandler', [FormController::class, 'index'])->name('form');

Route::get('/demo', function() {
    $tables = DB::select('SHOW TABLES');
    $list = DB::getSchemaBuilder()->getColumnListing('users');
    dump($list);
    dd($tables);
});