<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
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

        if (Invoice::where('customer_id', '=', $request['customer_id'])->where('month', '=', $month_name)->where('year', '=', $request['year'])->exists()) {

            $response['message'] = "Invoice already exists";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);

        }else{

            if ($invoice->save()) {
                $response['invoice_id'] = $invoice->id;
                $response['message'] = "Invoice created successfully";
                return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
            } else {
                $response['message'] = "Invoice can't be created";
                return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
            }

        }
    }

    public function customer_invoices(Request $request){

        $list = Invoice::all()->where('customer_id',$request['id'])->toArray();

        if(($list)){
            $response['customer_id'] = $request['id'];
            $response['invoice_list'] = $list;
            $response['message'] = "Customer invoices received successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        }else{
            $response['message'] = "Customer invoices can't be received";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }
}
