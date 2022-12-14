<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/login', function(){
    if (Auth::user()) {
        return redirect('/');
    } else {
        return view('pages.login');
    }
})->name('login');

Route::get('/register', function(){
    if (Auth::user()) {
        return redirect('/');
    } else {
        return view('pages.register');
    }
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('log-in');
Route::post('/custom-login', [AuthController::class, 'custom_login'])->name('custom-login');
Route::post('/register', [AuthController::class, 'register'])->name('signup');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', function(){
    return view('pages.forgot-password');
})->name('forgot-password');

Route::get('/subscription-cancel', function(){
    return view('mail.subscriptioncancel');
});
Route::get('/subscription-success', function(){
    return view('mail.subscriptionsuccess');
});

Route::post('/forgot-password', [UserAuthController::class, 'forgot_password'])->name('forgot_password');

Route::get('/reset-password', [UserAuthController::class, 'reset_password'])->name('reset-password');
Route::post('/update-password', [UserAuthController::class, 'update_password'])->name('update-password');

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
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/cancel-subscription', [ProfileController::class, 'cancelSubscription'])->name('cancel-subscription');

Route::get('/signup-mail', function(){
    return view('mail.signuptemplate');
})->name('cron-event');