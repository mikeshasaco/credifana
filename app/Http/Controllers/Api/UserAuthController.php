<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RealtorSubscription;
use App\Mail\ResetPasswordEmail;
use App\Mail\SubscriptionSuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Exception;

class UserAuthController extends Controller
{
    public function login(Request $request) {
        $login_data = Validator::make($request->all(), [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if (!$login_data->fails()) {
            try {
                $validated = $login_data->validated();
                $user_data = User::where('email', $validated['email'])->first();
                $user_data->token = encrypt($user_data->email); 

                if ($user_data && $user_data->count() > 0) {
                    if (Hash::check($validated['password'], $user_data->password)) {
                        return response()->json([
                            'status' => 'success',
                            'user_data' => $user_data
                        ]);
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Invalid Credentials'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid Credentials'
                    ]);
                }

            } catch (\Throwable $th) {
                
                return response()->json([
                    'status' => 'error',
                    'message' => $th->getMessage()
                ]);

            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'please enter valid data'
            ]);
        }

    }

    public function register(Request $request) {
        $reg_data = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email:filter|unique:App\Models\User,email',
            'password' => 'required'
        ]);

        if ($reg_data->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $reg_data->errors()
            ]);
        }
        try {
            $user_data = $reg_data->validated();
            $user_data['password'] = Hash::make($user_data['password']);
            $registeredUser = User::create($user_data);
            
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

            Mail::to($user_data['email'])->send(new SubscriptionSuccess(['username' => $username, 'plan_type' => $plan_type]));
            
            return response()->json([
                'status' => 'success',
                'user_data' => $registeredUser
            ]);

        } catch (\Throwable $th) {
            
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);

        }
    }

    public function userDetail(Request $request){
        try {
            if($request->id == ''){
                throw new Exception("user not exist.");
            }
            $userSubs = RealtorSubscription::where('user_id',$request->id)->first();
            if($userSubs == null){
                throw new Exception("user not found.");
            }
            return response()->json([
                'status' => 'success',
                'data' => $userSubs->toArray()
            ]);
        } catch (Exception $e) {
           return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function reset_password(Request $request)
    { 
        try {
            if ($request->isMethod('get') && ( $request->input('token') != null || $request->input('token') != '' )) {
                $token = $request->input('token');
                $email = decrypt($token);

                $user = User::where('email', $email)->first();

                if ($user) {
                    return view('pages.reset-password', ['email' => $email]);
                } else {
                    throw new Exception();
                }
            }
        } catch (Exception $e) {
            return redirect()->route('home');
        }
    }

    public function forgot_password(Request $request)
    {   
        try {
            $request->validate([
                'email' => 'required|email'
            ]);
    
            $email = $request->input('email') != null && $request->input('email') != '' ? $request->input('email') : '';
    
            if ($email != '') {
                $user = User::where('email', $email)->first();
                if ($user) {
                    Mail::to($email)->send(new ResetPasswordEmail(['email' => $email]));
                    return back()->with('success', __('Please check your email to reset password.'));

                } else {
                    throw new Exception("Email not found.");
                }
            }
        } catch (Exception $e) {
            return back()->with('error', __($e->getMessage()));
        }
    }
    
    public function update_password(Request $request)
    {
        try {
            if ($request->method('post')) {
                $request->validate(
                    [
                        'new_password' => 'required|min:6',
                        'confirm_password' => 'required|min:6'
                    ], 
                    [
                        'new_password' => 'Please enter valid password',
                        'confirm_password' => 'Please enter valid password'
                    ]
                );
                
                $new_password = $request->input('new_password');
                $confirm_password = $request->input('confirm_password');
                $email = $request->input('email');

                if ($new_password == $confirm_password) {
                    $new_password = Hash::make($new_password);
                    $user_data = User::where('email', $email)->update(['password' => $new_password]);
                   
                    return redirect()->to('forgot-password')->with('success', __('Password successfully updated.'));
                }  else {
                    throw new Exception("Password and Confirm Password does not match.");
                }
            } else {
                throw new Exception("Invalid Method Call.");
            }
        } catch (Exception $e) {
            return back()->with('error', __($e->getMessage()));
        }
    }
    
}