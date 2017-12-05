<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Invoice;
use Validator;
use DateTime;


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
        $input = array();
        $invoice = Invoice::find($request->invoice_id);
        $input['invoice_id'] = $request->invoice_id;
        $input['receiver_id'] = $request->receiver_id;
        $input['amount'] = $request->amount;
        $dt =  new DateTime();
        $input['date'] = $dt;
        $pay = Payment::create($input);

        if($pay){
            $total_pay = $invoice->payments->sum('amount');
            if($total_pay >= $invoice->invoice_amount) {
              $invoice->update(array('is_paid' => 1));
            }
            $response['message'] = "Payments created successfully";
            return response()->json(['status' => 200, 'response' => $response]);
        } else{
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