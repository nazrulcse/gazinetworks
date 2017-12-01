<?php

namespace App\Http\Controllers\API\v1;

use App\Complain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ComplainController extends Controller
{

    public function store(Request $request){

        $input = $request->all();
        $complain = Complain::create($input);

        if(($complain)){
            $response['message'] = "Complain created successfully";
            return response()->json(['status' => 200, 'response' => $response]);
        }else{
            $response['message'] = "Complain can't be created";
            return response()->json(['status' => 100, 'response' => $response]);
        }

    }
}
