<?php

namespace App\Http\Controllers\API\v1;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function store(Request $request){


        $input = $request->all();
        $complain = Contact::create($input);

        if(($complain)){
            $response['message'] = "Contact data created successfully";
            return response()->json(['status' => 200, 'response' => $response]);
        }else{
            $response['message'] = "Contact data can't be created";
            return response()->json(['status' => 100, 'response' => $response]);
        }

    }
}
