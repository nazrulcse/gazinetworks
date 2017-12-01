<?php

namespace App\Http\Controllers\API\v1;

use App\Complain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplainController extends Controller
{
    public function store(Request $request){

        $user = Auth::user();
        $input = $request->all();
        $input['customer_id'] = $user->id;
        $complain = Complain::create($input);

        if(($complain)){
            $response['message'] = "Complain created successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        }else{
            $response['message'] = "Complain can't be created";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }
}
