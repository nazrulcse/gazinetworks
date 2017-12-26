<?php

namespace App\Http\Controllers\API\v1;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Payment;
use App\Invoice;

class CustomerController extends Controller
{
    public function index(Request $request){
      $response = array();
      $customers = Role::where('name','customer')->first()->users()->get();
      foreach ($customers as $key => $customer) {
      	$api_customer = array();
      	$api_customer['id'] = $customer->id;
      	$api_customer['customer_id'] = $customer->customer_id;
      	$api_customer['name'] = $customer->name;
      	$api_customer['address'] = $customer->address;
      	$api_customer['mobile'] = $customer->phone;
      	$api_customer['tv'] = $customer->customer_tv_count;
      	$api_customer['due'] = $customer->total_due();
      	$response[$key] = $api_customer;
      }
      return response()->json(['status' => 200, 'response' => $response]);
    }

    public function show($id) {
    	$customer = User::find($id);
        $response = array();
        $response['name'] = $customer->name;
        $response['address'] = $customer->address;
        $response['mobile'] = $customer->phone;
        $response['tv'] = $customer->customer_tv_count;
        $response['line_charge'] = $customer->customer_monthly_bill;
        if($customer->invoices->count() > 0) {
          $response['last_bill'] = $customer->invoices->last()->is_paid;
        }
        $response['invoices'] = array();
        $invoices = $customer->invoices;
        foreach ($invoices as $key => $invoice) {
        	$res_invoice = array();
        	$res_invoice['id'] = $invoice->id;
        	$res_invoice['month'] = $invoice->month;
        	$res_invoice['amount'] = $invoice->invoice_amount;
        	$res_invoice['paid'] = $invoice->payments()->sum('amount');
        	$res_invoice['status'] = $invoice->is_paid;
        	$response['invoices'][] = $res_invoice;
        }
        return response()->json(['status' => 200, 'response' => $response]);
    }

    public function payments($customer_id) {
       $response = array();
       $payments = Payment::join('invoices', 'payments.invoice_id', '=', 'invoices.id')->where('invoices.customer_id', $customer_id)->get();
       foreach ($payments as $key => $payment) {
         $row = array();
         $row['id'] = $payment->id;
         $row['month'] = $payment->invoice->month;
         $row['amount'] = $payment->amount;
         $row['date'] = $payment->created_at->format('Y-m-d');
         $response[] = $row;
       }
       return response()->json(['status' => 200, 'response' => $response]);
    }

    public function payment_state(Request $request) {
      $response = array();
      $payments = Invoice::where('customer_id', $request->customer_id)
      ->where('year', $request->year)->where('is_paid', true)->get()->groupBy('month');
      foreach ($payments as $key => $payment) {
        $response[] = $key;
      }
      return response()->json(['status' => 200, 'response' => $response]);
    }
}