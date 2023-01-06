<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionCancel;
use App\Models\RealtorSubscription;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    function index(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user_id = $user->id;
            
            $subscription = RealtorSubscription::where('user_id', $user_id)->first();
            $subscription->plan_end = date('dS, M Y', strtotime($subscription->plan_end));

            return view('pages.profile', ['user' => $user, 'subscription' => $subscription]);
        } else {
            return Redirect('/login');
        }
    }

    public function cancelSubscription(Request $request) {
        try {

            $user_id = Auth::user()->id;
            
            //check user exist or not
            $user = User::where('id', $user_id)->first();
            if($user == null){
                throw new Exception("user not found.");
            }
            $userSubData = RealtorSubscription::where('user_id',$user_id)->first();

            if($userSubData != null){
                if($userSubData->subscription_id != '' && $userSubData->subscription_id){

                    require base_path().'/vendor/autoload.php';
                    $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET_KEY"));
                 
                    //cancel subscription
                    $subscription = $stripe->subscriptions->cancel(
                            $userSubData->subscription_id,
                            []
                        );
                } else {
                    $result = $userSubData->update(['is_cancelled' => 1, 'subscription_id' => null]);
                    throw new Exception("Subscription does not exist", 1);
                }
                $result = $userSubData->update(['is_cancelled' => 1, 'subscription_id' => null]);
                $username = $user->fname .' '. $user->lname;
                Mail::to($user->email)->send(new SubscriptionCancel(['username' => $username]));
            }

            return back()->with('success', __('Your subscriptions cancelled successfully.'));
            
        } catch (Exception $e) {
            return back()->with('error', __($e->getMessage()));
        }
    }
}
