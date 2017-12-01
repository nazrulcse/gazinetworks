<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Invoice;
use Validator;


class PaymentController extends Controller{

    public $successStatus = 200;
    public $failureStatus = 100;

    public function index(){
        $payments = Payment::all()->toArray();
        if(($payments)){
            $response['all_payments'] = $payments;
            $response['message'] = "All payments received successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        }else{
            $response['message'] = "Payments can't be received";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }


    public function store(Request $request){

        $input = $request->all();
        $input['invoice_id'] = $request->invoice_id;
        $input['receiver_id'] = $request->receiver_id;
        $dt =  new DateTime();
        $input['date'] = $dt;

        $pay = Payment::create($input);

        if($pay){
            Invoice::where('id', $request['invoice'])->update(array('status' => 1));
            $response['message'] = "Payments created successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        }else{
            $response['message'] = "Payment can't be created";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }

    public function destroy($id){

        $paymnet = Payment::find($id);

        if($paymnet){
            Invoice::where('id', $paymnet->invoice_id)->update(array('status' => 0));
            $paymnet->delete();
            $response['message'] = "Payments deleted successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        }else{
            $response['message'] = "Payment can't be deleted";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }
}