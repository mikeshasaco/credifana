<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionCancel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\RealtorSubscription;
use App\Models\RealtorPropertyHistory;
use Exception;

class PropertyController extends Controller{

    public function getPropertyDetails(Request $request) {
        try {
            if (!isset($request->user_id) || $request->user_id == '') {
                throw new Exception("user not exist.");
            }
        
            if (!isset($request->property_type) || $request->property_type == '') {
                throw new Exception("property type not found.");
            }

            $allowed_property_types = ['Multi-Family', 'Townhome', 'Single Family', 'Condo'];

            if(!in_array($request->property_type, $allowed_property_types)){
                throw new Exception("property type not match with our criteria.");
            }

            if($request->property_type == 'Multi-Family'){
                $request->property_type = 'Apartment';
            }else if($request->property_type == 'Townhome'){
                $request->property_type = 'Townhouse';
            }else if($request->property_type == 'Single Family'){
                $request->property_type = 'Single Family';
            }else if($request->property_type == 'Condo'){
                $request->property_type = 'Condo';
            }else{
                throw new Exception("property type does not match with our criteria.");
            }

            if (!isset($request->city) || $request->city == '') {
                throw new Exception("please enter city.");
            }        
            if (!isset($request->state) || $request->state == '') {
                throw new Exception("please enter state.");
            }        
            if (!isset($request->bedrooms) || $request->bedrooms == '' || $request->bedrooms <= 0) {
                throw new Exception("please enter valid bedroom.");
            }
            if (!isset($request->bathrooms) || $request->bathrooms == '' || $request->bathrooms <= 0) {
                throw new Exception("please enter valid bathroom.");
            }

            if (!isset($request->property_price) || $request->property_price == '') {
                throw new Exception("Property price not found.");
            }
            
            if (!isset($request->downpayment_percent) || $request->downpayment_percent == '' || $request->downpayment_percent <= 0 || $request->downpayment_percent > 100) {
                throw new Exception("Please enter valid down payment.");
            }
            
            if (!isset($request->interest_rate) || $request->interest_rate == '' || $request->interest_rate <= 0 || $request->interest_rate > 100) {
                throw new Exception("Please enter valid interest rate.");
            }

            if (!isset($request->unit) || $request->unit == '' || $request->unit <= 0) {
                throw new Exception("Please enter valid unit for property.");
            }

            if (!isset($request->closing_cost_percent) || $request->closing_cost_percent == '' || $request->closing_cost_percent <= 0 || $request->closing_cost_percent > 100) {
                throw new Exception("Please enter valid closing cost rate.");
            }

            if (!isset($request->vacancy) || $request->vacancy == '' || $request->vacancy < 0 || $request->vacancy > 100) {
                throw new Exception("Please enter valid vacancy rate, or put 0.");
            }

            if (!isset($request->maintenance) || $request->maintenance == '' || $request->maintenance < 0 || $request->maintenance > 100) {
                throw new Exception("Please enter valid maintenance rate, or put 0.");
            }

            if (!isset($request->management) || $request->management == '' || $request->management < 0 || $request->management > 100) {
                throw new Exception("Please enter valid management rate, or put 0.");
            }

            //check user exist or not
            $user = User::where('id',$request->user_id)->first();

            if($user == null){
                throw new Exception("user not found.");
            }

            //check user subscribed or not
            $subscriptions = RealtorSubscription::where('user_id',$request->user_id)->first();

            if($subscriptions == null){
                throw new Exception("please subscribed on credifana. <a href='".route('pricing')."?token=".encrypt($user->email)."' target='_blank'>Click Here</a>.");
            }else{

                //first check subscription status Active or not?
                // require base_path().'/vendor/autoload.php';
                // \Stripe\Stripe::setApiKey(env("STRIPE_SECRET_KEY"));

                // $subscription = \Stripe\Subscription::retrieve(
                //                     $subscriptions->subscription_id,
                //                     []
                //                 );

                $currentDate = date('Y-m-d');
                $ExpireDate = date('Y-m-d',strtotime($subscriptions->plan_end));
                if($ExpireDate >= $currentDate){
                    if($subscriptions->used_click < $subscriptions->total_click){
                        $dataToSend = [];
                        $final_bed_bath = [$request->bedrooms.'_'.$request->bathrooms];

                        if (isset($request->extra_bedrooms)) {
                            for ($i=0; $i < count($request->extra_bedrooms); $i++) {
                                array_push($final_bed_bath,$request->extra_bedrooms[$i].'_'.$request->extra_bathrooms[$i]);
                            }
                        }

                        foreach ($final_bed_bath as $key => $bedbath) {
                            if (!key_exists($bedbath, $dataToSend)) {
                                // Rapid API Call to get Rent on specific Area
                                $bed = explode('_', $bedbath)[0];
                                $bath = explode('_', $bedbath)[1];
                                
                                $curl = curl_init();
                                curl_setopt_array($curl, [
                                    CURLOPT_URL => "https://realty-mole-property-api.p.rapidapi.com/rentalListings?city=".$request->city."&state=".$request->state."&propertyType=".$request->property_type."&bedrooms=".$bed."&bathrooms=".$bath,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 30,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "GET",
                                    CURLOPT_HTTPHEADER => [
                                        "X-RapidAPI-Host: ".env("X_RAPIDAPI_HOST"),
                                        "X-RapidAPI-Key: ".env("X_RAPIDAPI_KEY")
                                    ],
                                ]);

                                $response = curl_exec($curl);
                                $reserr = $response;
                                $err = curl_error($curl);
                                $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                                curl_close($curl);
                                if ($err || $http_status == 403) {
                                    if($http_status == 403){
                                        $err = 'Something went wrong, Please try again later.';
                                    }
                                    throw new Exception($err);
                                } else {
                                    $response = json_decode($response,true);
                                    if(isset($response) && count($response) > 0){
                                        $rentFromApi = array_sum(array_column($response,'price'))/count($response);
                                        $highestRent = max(array_column($response,'price'));
                                        $property_price = $request->property_price; // from extnsn
                                        $property_image = $request->property_image; // from extnsn
                                        $property_name = $request->property_name; // from extnsn
        
                                        $downpayment_percent = $request->downpayment_percent; // from extnsn
                                        $downpayment_payment = ($property_price * $downpayment_percent) / 100;
                                        $mortgage = $property_price - $downpayment_payment;
                                                                
                                        $closing_cost_percent = $request->closing_cost_percent; // from extnsn
                                        $closing_cost_amount = ($property_price * $closing_cost_percent) / 100;
        
        
                                        $estimate_cost_of_repair = (isset($request->estimate_cost_of_repair) && $request->estimate_cost_of_repair != '') ? $request->estimate_cost_of_repair : 0; // from extnsn
                                        $total_capital_needed = $downpayment_payment + $closing_cost_amount + $estimate_cost_of_repair;
        
                                        $loan_term_years = $request->loan_term_years ?? 30; // from extnsn
                                        $interest_rate = $request->interest_rate; // from extnsn
        
                                        //calculate principal and interest
                                        $power = $loan_term_years * 12;
                                        $rateformula = pow((($interest_rate / 1200) + 1), $power);
                                        
                                        $principal_and_interest = floor(((($mortgage * ($interest_rate / 1200)) * $rateformula) / ($rateformula - 1)));
                                        
                                        //Unit for multi-family if another property type then default 1 unit and user can change it
                                        $unit = $request->unit;
        
                                        $gross_monthly_income = $rentFromApi * $unit;
                                        $gross_yearly_income = floor($gross_monthly_income * 12);
        
                                        $taxes = (isset($request->taxes) && $request->taxes != '') ? $request->taxes : 0;
                                        $insurance = (isset($request->insurance) && $request->insurance != '') ? $request->insurance : 0;
        
                                        if($request->vacancy == 0){
                                            $vacancy = 0;
                                        }else{
                                            $vacancy = ($gross_monthly_income * $request->vacancy) / 100;
                                        }
        
                                        if($request->maintenance == 0){
                                            $maintenance = 0;
                                        }else{
                                            $maintenance = ($gross_monthly_income * $request->maintenance) / 100;
                                        }
        
                                        if($request->management == 0){
                                            $management = 0;
                                        }else{
                                            $management = ($gross_monthly_income * $request->management) / 100;
                                        }
                                           
        
                                        $totalMonthlyCost = $taxes + $insurance + $vacancy + $maintenance + $management;
                                        $totalYearlyCost = $totalMonthlyCost * 12;
        
                                        $monthlyNetOperator = $gross_monthly_income - $totalMonthlyCost;
                                        $yearlyNetOperator = $monthlyNetOperator * 12;
        
                                        $cap_rate = number_format($yearlyNetOperator / $property_price,2);
        
                                        $total_cash_flow_monthly = $monthlyNetOperator - $principal_and_interest;
                                        $total_cash_flow_yearly = $total_cash_flow_monthly * 12;
        
                                        $cash_on_cash_return = number_format($total_cash_flow_yearly / $total_capital_needed,2);
        
                                        RealtorSubscription::where('user_id',$request->user_id)->update(['used_click' => ($subscriptions->used_click + 1)]);
                                        
                                        $basicData = [
                                            "average_rent_formula" => count($response)." ".$request->property_type.", Bedroom: ".$bed." and Bathroom: ".$bath.", Average rent: $".number_format($rentFromApi,2),
                                            "property_price" => number_format($property_price),
                                            "property_image" => $property_image,
                                            "property_type" => $request->property_type,
                                            "property_name" => $property_name,
                                            "city" => $request->city,
                                            "state" => $request->state,
                                            "bedrooms" => $bed,
                                            "bathrooms" => $bath,
                                            "property_count" => count($response),
                                            "state" => $request->state,
                                            "average_rent" => "$".number_format($rentFromApi,2),
                                            "principal_and_interest" => "$".number_format($principal_and_interest,2),
                                            "downpayment_percent" => $downpayment_percent,
                                            "downpayment" => "$".number_format($downpayment_payment,2),
                                            "mortgage" => "$".number_format($mortgage,2),
                                            "closingcost_per" => $closing_cost_percent,
                                            "closingcost" => "$".number_format($closing_cost_amount,2),
                                            "estimate_costofrepair" => "$".number_format($estimate_cost_of_repair,2),
                                            "total_capital_needed" => "$".number_format($total_capital_needed,2),
                                            "loanterm" => $loan_term_years." Years",
                                            "interestrate" => $interest_rate."%",
                                            "unit" => $unit,
                                            "gross_monthly_income" => "$".number_format($gross_monthly_income,2),
                                            "gross_yearly_income" => "$".number_format($gross_yearly_income,2),
                                            "taxes" => "$".number_format($taxes,2),
                                            "insurance" => "$".number_format($insurance,2),
                                            "vacancy_percent" => $request->vacancy,
                                            "vacancy" => "$".number_format($vacancy,2),
                                            "maintenance_percent" => $request->maintenance,
                                            "maintenance" => "$".number_format($maintenance,2),
                                            "management_percent" => $request->management,
                                            "management" => "$".number_format($management,2),
                                            "total_monthly_cost"  => "$".number_format($totalMonthlyCost,2),
                                            "total_yearly_cost"  => "$".number_format($totalYearlyCost,2),
                                            "user_current_plan_name"  => $subscriptions->plan_name,
                                            "highest_rent" => '',
                                            "monthly_net_operator"  => '',
                                            "yearly_net_operator"  => '',
                                            "cap_rate"  => '',
                                            "total_cash_flow_monthly"  => '',
                                            "total_cash_flow_yearly"  => '',
                                            "cash_on_cash_return"  => '',
                                            "extra_bed_bath"  => $final_bed_bath
                                        ];
        
                                        if($subscriptions->plan_name != "basic"){
                                            $basicData["highest_rent"] = "$".number_format($highestRent,2);
                                            $basicData["monthly_net_operator"] = "$".number_format($monthlyNetOperator,2);
                                            $basicData["yearly_net_operator"] = "$".number_format($yearlyNetOperator,2);
                                            $basicData["cap_rate"] = $cap_rate;
                                            $basicData["total_cash_flow_monthly"] = "$".number_format($total_cash_flow_monthly,2);
                                            $basicData["total_cash_flow_yearly"] = "$".number_format($total_cash_flow_yearly,2);
                                            $basicData["cash_on_cash_return"] = number_format($cash_on_cash_return,2);
                                        }
        
                                        $dataToSend[$bedbath] = $basicData;
                                    }else{
                                        throw new Exception("Properties does not found for specific city and state.");
                                    }
                                }
                            }
                        }

                        $dataToSend['last_id'] = RealtorPropertyHistory::insertGetId(["user_id" => $request->user_id, 'plan_name' => $subscriptions->plan_name,  "pro_detail" => json_encode($dataToSend)]);
                                    
                        return response()->json([
                            'status' => 'success',
                            'message' => '',
                            'data' => $dataToSend
                        ], 200);

                    }else{
                        throw new Exception("You have reached your maximum limit. please upgrade your plan on credifana. <a href='".route('pricing')."?token=".encrypt($user->email)."' target='_blank'>Click Here</a>.");
                    }
                }else{
                    $subscriptions->update(['is_cancelled' => 1]);
                    throw new Exception("Your Subscription has been expired or cancelled. please subscribed on credifana. <a href='".route('pricing')."?token=".encrypt($user->email)."' target='_blank'>Click Here</a>.");
                }
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getSubscriptionDetails(Request $request) {
       
        try {
            if (!isset($request->id) || $request->id == '') {
                throw new Exception("user not exist.");
            }

            //check user exist or not
            $user = User::where('id',$request->id)->first();
            if($user == null){
                throw new Exception("user not found.");
            }


            $resData = [];
            $userSubData = RealtorSubscription::where('user_id',$request->id)->first();
            if($userSubData == null){
                throw new Exception("please subscribed on credifana. <a href='".route('pricing')."?token=".encrypt($user->email)."' target='_blank'>Click Here</a>.");
            }else{
                
                // require base_path().'/vendor/autoload.php';
                // \Stripe\Stripe::setApiKey(env("STRIPE_SECRET_KEY"));

                // $subscription = \Stripe\Subscription::retrieve(
                //                     $userSubData->subscription_id,
                //                     []
                //                 );

                $resData["plan"] = ucfirst($userSubData->plan_name);
                $resData["plan_start"] = date('jS M Y', strtotime($userSubData->plan_start));
                $resData["plan_end"] = date('jS M Y', strtotime($userSubData->plan_end));
                $resData["is_cancelled"] = $userSubData->is_cancelled;
                $resData["used_click"] = $userSubData->used_click;
                $resData["total_click"] = $userSubData->total_click;
                $resData["change_plan"] = route('pricing')."?token=".encrypt($user->email);

                return response()->json([
                    'status' => 'success',
                    'message' => '',
                    'data' => $resData
                ],200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],200);
        }
    }

    public function cancelSubscription(Request $request) {
        try {

            if (!isset($request->id) || $request->id == '') {
                throw new Exception("user not exist.");
            }

            //check user exist or not
            $user = User::where('id', $request->id)->first();
            if($user == null){
                throw new Exception("user not found.");
            }
            $userSubData = RealtorSubscription::where('user_id',$request->id)->first();

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
            return response()->json([
                'status' => 'success',
                'message' => 'Your subscriptions cancelled successfully.',
                'data' => []
            ],200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function getPropertyHistory(Request $request){
        try {
            if (!isset($request->id) || $request->id == '') {
                throw new Exception("user not exist.");
            }

            //check user exist or not
            $user = User::join('realtor_subscriptions','users.id','=','realtor_subscriptions.user_id')
                        ->select('users.*','plan_name')
                        ->where('users.id',$request->id)->first();
            
            if($user == null){
                throw new Exception("user not found.");
            }

            $proHistoryData = RealtorPropertyHistory::where('user_id',$request->id)->where('plan_name', '!=', 'basic')->orderBy('id','DESC')->get()->toArray();
            return response()->json([
                'status' => 'success',
                'message' => '',
                'data' => ['user_plan_name' => $user->plan_name, 'proHistoryData' => $proHistoryData]
            ],200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function propertyRegenerateDetails(Request $request) {
        try {
            if (!isset($request->property_id) || $request->property_id == '') {
                throw new Exception("property not exist.");
            }
            if (!isset($request->user_id) || $request->user_id == '') {
                throw new Exception("user not exist.");
            }
            if (!isset($request->clicktype) || $request->clicktype == '') {
                throw new Exception("soemthing went wrong, try again later.");
            }

            if ($request->clicktype == 'changeProDetails' && (!(isset($request->active_unit)) || $request->active_unit == '')) {
                throw new Exception("soemthing went wrong, try again later.");
            }

            if ($request->clicktype == 'options_btn' && (!isset($request->rentValue) || $request->rentValue == '')) {
                throw new Exception("soemthing went wrong with increase rent value.");
            }

            $userSubData = RealtorSubscription::where('user_id',$request->user_id)->first();

            $propertyData = RealtorPropertyHistory::where('id',$request->property_id)
                                                    ->where('user_id',$request->user_id)
                                                    ->first();
            if($propertyData == null){
                throw new Exception("property not found.");
            }

            $propertyData = json_decode($propertyData->pro_detail,true);
            $propertyData = $request->active_unit ? $propertyData[$request->active_unit] : $value = reset($propertyData);

            if($request->clicktype == 'options_btn'){
                $rentFromApi = str_ireplace(array('$',','), '', $propertyData['average_rent']);
                $rentFromApi = (($rentFromApi * $request->rentValue) / 100) + $rentFromApi;
            }else if($request->clicktype == 'highest_rent'){
                $rentFromApi = str_ireplace(array('$',','), '', $propertyData['highest_rent']);
            }else{
                $rentFromApi = str_ireplace(array('$',','), '', $propertyData['average_rent']);
            }
            
            $highestRent = str_ireplace(array('$',','), '', $propertyData['highest_rent']);
            
            $property_price = str_ireplace(array('$',','), '', $propertyData['property_price']);
            $property_image = $propertyData['property_image'];
            $property_name = $propertyData['property_name'];

            $downpayment_percent = $propertyData['downpayment_percent'];
            $downpayment_payment = ($property_price * $downpayment_percent) / 100;
            $mortgage = $property_price - $downpayment_payment;
                                    
            $closing_cost_percent = $propertyData['closingcost_per'];
            $closing_cost_amount = ($property_price * $closing_cost_percent) / 100;


            $estimate_cost_of_repair = str_ireplace(array('$',','), '', $propertyData['estimate_costofrepair']);
            $total_capital_needed = $downpayment_payment + $closing_cost_amount + $estimate_cost_of_repair;

            $loan_term_years = str_ireplace(' Years', '', $propertyData['loanterm']);
            $interest_rate = str_ireplace('%', '', $propertyData['interestrate']);

            //calculate principal and interest
            $power = $loan_term_years * 12;
            $rateformula = pow((($interest_rate / 1200) + 1), $power);
            
            $principal_and_interest = floor(((($mortgage * ($interest_rate / 1200)) * $rateformula) / ($rateformula - 1)));
            
            //Unit for multi-family if another property type then default 1 unit and user can change it
            $unit = $propertyData['unit'];

            $gross_monthly_income = $rentFromApi * $unit;
            $gross_yearly_income = floor($gross_monthly_income * 12);

            $taxes = str_ireplace(array('$',','), '', $propertyData['taxes']);
            $insurance = str_ireplace(array('$',','), '', $propertyData['insurance']);


            if($propertyData['vacancy_percent'] == 0){
                $vacancy = 0;   
            }else{
                $vacancy = ($gross_monthly_income * $propertyData['vacancy_percent']) / 100;   

            }

            if($propertyData['maintenance_percent'] == 0){
                $maintenance = 0;   
            }else{
                $maintenance = ($gross_monthly_income * $propertyData['maintenance_percent']) / 100;
            }

            if($propertyData['management_percent'] == 0){
                $management = 0;   
            }else{
                $management = ($gross_monthly_income * $propertyData['management_percent']) / 100;
            }

            $totalMonthlyCost = $taxes + $insurance + $vacancy + $maintenance + $management;
            $totalYearlyCost = $totalMonthlyCost * 12;

            $monthlyNetOperator = $gross_monthly_income - $totalMonthlyCost;
            $yearlyNetOperator = $monthlyNetOperator * 12;

            $cap_rate = number_format($yearlyNetOperator / $property_price,2);

            $total_cash_flow_monthly = $monthlyNetOperator - $principal_and_interest;
            $total_cash_flow_yearly = $total_cash_flow_monthly * 12;

            $cash_on_cash_return = number_format($total_cash_flow_yearly / $total_capital_needed,2);

            
            $basicData = [
                        "average_rent_formula" => $propertyData['property_count']." ".$propertyData['property_type'].", Bedroom: ".$propertyData['bedrooms']." and Bathroom: ".$propertyData['bathrooms'].", Average rent: $".number_format($rentFromApi,2),
                        "property_price" => number_format($property_price),
                        "property_image" => $property_image,
                        "property_type" => $propertyData['property_type'],
                        "property_name" => $property_name,
                        "city" => $propertyData['city'],
                        "state" => $propertyData['state'],
                        "average_rent" => "$".number_format($rentFromApi,2),
                        "principal_and_interest" => "$".number_format($principal_and_interest,2),
                        "downpayment_percent" => $downpayment_percent,
                        "downpayment" => "$".number_format($downpayment_payment,2),
                        "mortgage" => "$".number_format($mortgage,2),
                        "closingcost_per" => $closing_cost_percent,
                        "closingcost" => "$".number_format($closing_cost_amount,2),
                        "estimate_costofrepair" => "$".number_format($estimate_cost_of_repair,2),
                        "total_capital_needed" => "$".number_format($total_capital_needed,2),
                        "loanterm" => $loan_term_years." Years",
                        "interestrate" => $interest_rate."%",
                        "unit" => $unit,
                        "gross_monthly_income" => "$".number_format($gross_monthly_income,2),
                        "gross_yearly_income" => "$".number_format($gross_yearly_income,2),
                        "taxes" => "$".number_format($taxes,2),
                        "insurance" => "$".number_format($insurance,2),
                        "vacancy_percent" => $propertyData['vacancy_percent'],
                        "vacancy" => "$".number_format($vacancy,2),
                        "maintenance_percent" => $propertyData['maintenance_percent'],
                        "maintenance" => "$".number_format($maintenance,2),
                        "management_percent" => $propertyData['management_percent'],
                        "management" => "$".number_format($management,2),
                        "total_monthly_cost"  => "$".number_format($totalMonthlyCost,2),
                        "total_yearly_cost"  => "$".number_format($totalYearlyCost,2),
                        "user_current_plan_name"  => $userSubData->plan_name,
                        "highest_rent" => '',
                        "monthly_net_operator"  => '',
                        "yearly_net_operator"  => '',
                        "cap_rate"  => '',
                        "total_cash_flow_monthly"  => '',
                        "total_cash_flow_yearly"  => '',
                        "cash_on_cash_return"  => ''
                    ];
                    
                    
            if($userSubData->plan_name != "basic"){
                $basicData["highest_rent"] = $highestRent != '' ? "$".number_format($highestRent,2) : '';
                $basicData["monthly_net_operator"]  = $monthlyNetOperator != '' ? "$".number_format($monthlyNetOperator,2) : '';
                $basicData["yearly_net_operator"]  = $yearlyNetOperator != '' ? "$".number_format($yearlyNetOperator,2) : '';
                $basicData["cap_rate"]  = $cap_rate != '' ? $cap_rate : '';
                $basicData["total_cash_flow_monthly"]  = $total_cash_flow_monthly != '' ? "$".number_format($total_cash_flow_monthly,2) : '';
                $basicData["total_cash_flow_yearly"]  = $total_cash_flow_yearly != '' ? "$".number_format($total_cash_flow_yearly,2) : '';
                $basicData["cash_on_cash_return"]  = $cash_on_cash_return != '' ? number_format($cash_on_cash_return,2) : '';
            }

            $dataToSend = $basicData;
                            
            $dataToSend['last_id'] = $request->property_id;
            
            return response()->json([
            'status' => 'success',
            'message' => '',
            'data' => $dataToSend
        ], 200);

        } catch (Exception $e) {
            
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);

        }
    }

}
