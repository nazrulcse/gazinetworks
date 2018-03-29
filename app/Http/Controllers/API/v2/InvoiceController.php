<?php

namespace App\Http\Controllers\API\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Invoice;
use Validator;
use DateTime;


class InvoiceController extends Controller
{

    public $successStatus = 200;
    public $failureStatus = 100;



    public function index(Request $request) {
        $response = array();
        $invoices = Invoice::where('is_paid', false)->where('customer_id','!=' , 0);

        if ($request->has('page')) {
            $invoices = $invoices->paginate(20);
        } else {
            $invoices = $invoices->get();
        }

        foreach ($invoices as $key => $invoice) {
            $customer_info = array();
            $customer = $invoice->user;
            $customer_info['name'] = $customer->name;
            $customer_info['address'] = $customer->address;
            $customer_info['mobile'] = $customer->phone;
            $customer_info['tv'] = $customer->customer_tv_count;
            $customer_info['status'] = $invoice->is_paid;
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

    public function store(Request $request){

        $invoice = new Invoice();
        $input = $request->all();

        $date = DateTime::createFromFormat("d-m-Y", $input['invoice_date']);


        $month_name = date("F", mktime(0, 0, 0, $date->format("m"), 15));
        $invoice['date'] = $date->format("d");
        $invoice['month'] = $month_name;
        $invoice['year'] = $date->format("Y");

        if ($request->has('customer_id')){

            $customer_bill = User::where('id', $request['customer_id'])->first()->customer_monthly_bill;
            $invoice['customer_id'] = $request['customer_id'];
            $invoice['invoice_amount'] = $customer_bill;


            if (Invoice::where('customer_id', '=', $request['customer_id'])->where('month', '=', $invoice['month'])->where('year', '=', $invoice['year'])->exists()) {

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
        }else{
            $invoice['invoice_amount'] = $input['invoice_amount'];
            $invoice['other_invoice_title'] = $input['other_invoice_title'];
            if ($invoice->save()) {
                $response['invoice_id'] = $invoice->id;
                $response['message'] = "Other Income Invoice created successfully";
                return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
            } else {
                $response['message'] = "Other Income Invoice can't be created";
                return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
            }
        }

    }

    public function show($id) {
        $invoice = Invoice::find($id);
        $response = array();

        $response['invoice_id'] = $invoice->id;
        $response['month'] = $invoice->month;
        $response['year'] = $invoice->year;
        $response['date'] = $invoice->date;
        $response['amount'] = $invoice->invoice_amount;

        if ($invoice->customer_id != 0){

            $customer = $invoice->user;
            $response['name'] = $customer->name;
            $response['address'] = $customer->address;
            $response['mobile'] = $customer->phone;
            $response['tv'] = $customer->customer_tv_count;
            $response['line_charge'] = $customer->customer_monthly_bill;
        }else{

            $response['other_invoice_title'] = $invoice->other_invoice_title;
        }

        $response['paid'] = $invoice->payments->sum('amount');
        $response['due'] = $response['amount'] - $response['paid'];
        $response['status'] = $invoice->is_paid;
        return response()->json(['status' => 200, 'response' => $response]);
    }

    public function other_income_invoices(Request $request){

        $response = array();

        $invoices = Invoice::where('customer_id', 0);
        if ($request->has('page')) {
            $invoices = $invoices->paginate(20);
        } else {
            $invoices = $invoices->get();
        }

        foreach ($invoices as $key => $invoice) {
            $row = array();
            $row['id'] = $invoice->id;
            $row['title'] = $invoice->other_invoice_title;
            $row['amount'] = $invoice->invoice_amount;
            $row['paid'] = $invoice->is_paid == 1 ? 'Full' : ($invoice->payments->sum('amount'));
            $row['due'] = $invoice->is_paid == 1 ? 'None' : ($invoice->invoice_amount - $invoice->payments->sum('amount'));
            $row['bill_period'] = $invoice->date.' '.$invoice->month.', '.$invoice->year;
            $row['creation_date'] = $invoice->created_at->format('Y-m-d');
            $response[] = $row;
        }
        return response()->json(['status' => 200, 'response' => $response]);
    }
}