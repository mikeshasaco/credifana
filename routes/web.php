<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
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

/**
 * Billing and Subscriptions
 */
Route::get('/billing', [BillingController::class, 'index'])->name('pricing');
    
Route::post('/billing-checkout', [BillingController::class, 'billingCheckout'])->name('billing-checkout');
Route::get('/thankyou', function(){
    return view('pages.thankyou');
})->name('thankyou');

Route::get('/privacy-policy', function(){
    return view('pages.privacy-policy');
})->name('privacy-policy');

Route::get('/terms-of-use', function(){
    return view('pages.terms-of-use');
})->name('terms-of-use');

Route::post('/webhook-event', [BillingController::class, 'webhookEvent'])->name('webhook-event');
Route::get('/test', [BillingController::class, 'check_test'])->name('test');
Route::get('/cron-event', [BillingController::class, 'cronEvent'])->name('cron-event');