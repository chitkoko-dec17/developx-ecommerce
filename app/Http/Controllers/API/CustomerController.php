<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Customer;
use App\Models\CustomerCoinLogs;
use Illuminate\Support\Facades\Auth;
use Validator;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Hash;

class CustomerController extends BaseController
{

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:15|unique:customers',
            'password' => 'required|string|min:6',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password']=Hash::make($request['password']);
        $input['status']="active";
        $input['total_coin']=0;
        $user = Customer::create($input);
        // $success['token'] =  $user->createToken('APIApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'Customer register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:15',
            'password' => 'required|string|min:6',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = Customer::where('phone', $request->phone)->first();
        if($user){
            if($user->status == 'active'){ 
                if(Hash::check($request->password, $user->password)){

                    $success['token'] =  $user->createToken('APIApp')->accessToken; 
                    $success['name'] =  $user->name;
                    $success['id'] =  $user->id;
           
                    return $this->sendResponse($success, 'Customer login successfully.');
                }else{
                    return $this->sendError('Error.', ['error'=>'Password mismatch']);
                }

            }elseif($user->status == 'inactive'){
                return $this->sendError('Error.', ['error'=>'Your account is inactive. Please contact to administrator.']);
            }
            
        }else{
            return $this->sendError('Error.', ['error'=>'Customer does not exist.']);
        }

        return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
    }


    public function customer($id)
    {

        $user = Customer::find($id);
        $success['user'] =  $user;
        return $this->sendResponse($success, 'Customer Data');
    }

    public function logout($id){
        $user = Customer::find($id);
        $tokens =  $user->tokens->pluck('id');
        Token::whereIn('id', $tokens)
            ->update(['revoked'=> true]);

        RefreshToken::whereIn('access_token_id', $tokens)->update(['revoked' => true]);

        $success['msg'] =  "Logout";
        return $this->sendResponse($success, 'You have been successfully logged out!');
    }

    public function get_customer_coin_history($id){
        $customer_coin_history = CustomerCoinLogs::where('customer_id', $id)->orderBy('id', 'desc')->get()->toArray();

        $format_customer_chist = array();
        foreach($customer_coin_history as $ind => $ch){

            $price = ($ch['price']) ? " (".$ch['price']."ကျပ်)" : "";

            $format_customer_chist[$ind]['id'] = $ch['id'];
            $format_customer_chist[$ind]['coin'] = $ch['coin'] . $price;
            $formatdate = strtotime( $ch['created_at'] );
            $format_customer_chist[$ind]['process_date'] = date('M j, Y - h:i A', $formatdate);
            if($ch['coin_log_type'] == "topup"){
                $format_customer_chist[$ind]['usage_type'] = "+Top Up";
            }elseif($ch['coin_log_type'] == "used"){
                $format_customer_chist[$ind]['usage_type'] = "-Coin Used";
            }
        }
        $success['customer_coin_history'] =  $format_customer_chist;
        return $this->sendResponse($success, 'Customer Coin History Data');
    }

}