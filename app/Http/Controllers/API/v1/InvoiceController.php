<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Invoice;
use App\Payment;
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

    public function index() {
        $response = array();
        $invoices = Invoice::all()->where('is_paid', false)->all();
        foreach ($invoices as $key => $invoice) {
           $customer_info = array();
           $customer = $invoice->user;
           $customer_info['name'] = $customer->name;
           $customer_info['address'] = $customer->address;
           $customer_info['mobile'] = $customer->phone;
           $customer_info['tv'] = $customer->customer_tv_count;
           $customer_info['staus'] = $invoice->is_paid;
           $customer_info['amount'] = $invoice->invoice_amount;
           $customer_info['paid'] = $invoice->payments->sum('amount');
           $customer_info['customer_id'] = $customer->id;
           $customer_info['login_id'] = $customer->customer_id;
           $customer_info['id'] = $invoice->id;
           $customer_info['month'] = $invoice->month;
           $response[] = $customer_info;
        }
        return response()->json(['status' => 200, 'response' => $response]);
    }

    public function show($id) {
        $invoice = Invoice::find($id);
        $customer = $invoice->user;
        $response = array();
        $response['name'] = $customer->name;
        $response['address'] = $customer->address;
        $response['mobile'] = $customer->phone;
        $response['tv'] = $customer->customer_tv_count;
        $response['line_charge'] = $customer->customer_monthly_bill;
        $response['invoice_id'] = $invoice->id;
        $response['month'] = $invoice->month;
        $response['amount'] = $invoice->invoice_amount;
        $response['paid'] = $invoice->payments->sum('amount');
        $response['due'] = $response['amount'] - $response['paid'];
        $response['status'] = $invoice->is_paid;
        return response()->json(['status' => 200, 'response' => $response]);
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