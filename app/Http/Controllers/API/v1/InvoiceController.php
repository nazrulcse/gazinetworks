<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Invoice;
use Illuminate\Support\Facades\Auth;
use Validator;

class InvoiceController extends Controller{

    public $successStatus = 200;
    public $failureStatus = 100;

    public function store(Request $request){

        $invoice = new Invoice();
        $month_name = date("F", mktime(0, 0, 0, $request['month'], 15));
        $customer_bill = User::where('id', $request['customer_id'])->first()->customer_monthly_bill;
        $invoice['month'] = $month_name;
        $invoice['invoice_amount'] = $customer_bill;
        $invoice['year'] = $request->year;
        $invoice['date'] = $request->date;
        $invoice['customer_id'] = $request->customer_id;
        if ($invoice->save()){
            $response['invoice_id'] = $invoice->id;
            $response['message'] = "Invoice created successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        }else{
            $response['message'] = "Invoice can't be created";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }

    public function customer_invoice(){
        
    }
}