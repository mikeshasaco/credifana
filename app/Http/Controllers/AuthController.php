<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\RealtorSubscription;
use App\Mail\SignupTemplate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function login(Request $request) {
        $login_data = Validator::make($request->all(), [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if (!$login_data->fails()) {
            try {
                $validated = $login_data->validated();
                
                if (Auth::attempt($validated)) {
                    $user = User::where('email', $validated['email'])->first();
                    $user->token = encrypt($user->email);
                    $user->PID = $user->password;
                    setCookie('UD', base64_encode($user), time() + 86400);

                    return redirect()->intended('/')->with('login', __(json_encode($user)));
                } else {
                    return back()->with('error', __('Invalid Credentials'));
                }

            } catch (Exception $e) {
                return back()->with('error', __($e->getMessage()));
            }
        } else {
            return back()->with('error', __('please enter valid data'));
        }

    }

    public function custom_login(Request $request) {

        if ($request->userData != '' || $request->userData != null) {
            $user_data['email'] = $request->userData['email'];
            $user_data['password'] = $request->userData['PID'];
            
            $login_data = Validator::make($user_data, [
                'email' => 'required|email:filter',
                'password' => 'required'
            ]);

            if (!$login_data->fails()) {
                try {
                    $validated = $login_data->validated();
                    $user = User::where('email', $validated['email'])->first();

                    if (Auth::loginUsingId($user->id)) {
                        return json_encode([
                            'status' => 'success' 
                        ]);
                    } else {
                        return json_encode([
                            'status' => 'error',
                            'message' => 'Authentication fails.'
                        ]);
                    }

                } catch (Exception $e) {
                    return json_encode([
                        'status' => 'error' ,
                        'message' => $e->getMessage()
                    ]);
                }
            } else {
                return back()->with('error', __('please enter valid data'));
            }
        }
    }

    public function register(Request $request) {
        $validated = $this->validate($request,[
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email:filter|unique:App\Models\User,email',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            $user_data = $validated;
            $user_data['password'] = Hash::make($user_data['password']);
            unset($user_data['_token']);
            unset($user_data['password_confirmation']);

            $registeredUser = User::create($user_data);
            $registeredUser->token = encrypt($registeredUser->email);
            
            //start basic plan for this user
            $subscriptionSaveData = [
                'user_id' => $registeredUser->id,
                'subscription_id' => null,
                'plan_name' => 'basic',
                'plan_start' => date('Y-m-d H:i:s'),
                'plan_end' => date('Y-m-d H:i:s', strtotime("+30 days")),
                'used_click' => 0,
                'total_click' => getTotalClicks('basic'),
            ];

            RealtorSubscription::insert($subscriptionSaveData);
            $username = $user_data['fname'] .' '. $user_data['lname'];
            $plan_type = $subscriptionSaveData['plan_name'];
            $total_click = $subscriptionSaveData['total_click'];
            $plan_start = date('jS F Y', strtotime($subscriptionSaveData['plan_start']));
            $plan_end = date('jS F Y', strtotime($subscriptionSaveData['plan_end']));

            Mail::to($user_data['email'])->send(new SignupTemplate(['username' => $username, 'plan_type' => $plan_type, 'total_click' => $total_click, 'plan_start' => $plan_start, 'plan_end' => $plan_end]));
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->intended('/')->with('success', __('User registered successfully'));
            }
        } catch (Exception $e) {
            return back()->with('error', __($e->getMessage()));
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {

        if (isset($_COOKIE['UD'])) {
            setcookie("UD", "", time() - 3600);
        }

        Session::flush();
        Auth::logout();
        
        return Redirect('/');
    }

}
