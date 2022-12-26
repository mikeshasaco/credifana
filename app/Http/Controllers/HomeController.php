<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index() {
        DB::statement("truncate table realtor_payment_histories");
        DB::statement("truncate table realtor_property_histories");
        DB::statement("truncate table realtor_subscriptions");
        DB::statement("truncate table users");
        exit('done...');
        return view('pages.home');
    }
}
