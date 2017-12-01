<?php

namespace App\Http\Controllers\API\v1;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function store(Request $request){

        $user = Auth::user();
        $input = $request->all();
        $input['customer_id'] = $user->id;
        $complain = Contact::create($input);

        if(($complain)){
            $response['message'] = "Contact data created successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        }else{
            $response['message'] = "Contact data can't be created";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }
}
