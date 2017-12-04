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
            $success['type'] =  'customer';

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
        return response()->json(['success' => $user], $this->successStatus);
    }

        public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}