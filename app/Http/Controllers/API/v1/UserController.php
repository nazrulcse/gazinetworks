<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{

    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['customer_id' => request('customer_id'),
            'password' => request('password')])){

            $user = Auth::user();
            $success['token'] =  $user->createToken('GaziNetworks')->accessToken;
            $success['message'] =  'Successfully logged in';
            $success['id'] =  $user->id;
            $success['type'] =  $user->roles->first()->name;
            $success['name'] =  $user->name;
            $success['login_id'] =  $user->customer_id;

            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorized'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('GaziNetworks')->accessToken;
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;
        $success['message'] =  'Registration Successful';

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function profile()
    {
        $user = Auth::user();
        $invoices = $user->invoices;
        $arr_invoice = array();
        foreach ($invoices as $key => $invoice) {
          $raw = array();
          $raw['month'] = $invoice->month;
          $raw['amount'] = $invoice->invoice_amount;
          $raw['paid'] = $invoice->payments->sum('amount');
          $raw['statue'] = $invoice->is_paid;
          $arr_invoice[] = $raw;
        }
        if($user->invoices->count() > 0) {
           $status = $user->invoices->last()->is_paid;
        }
        else {
           $status = false;
        }
        return response()->json(['success' => $user, 'last_invoice_status' => $status, 'invoices' => $arr_invoice], $this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user, 'invoices' => $user->invoices()->toArray()], $this->successStatus);
    }
}