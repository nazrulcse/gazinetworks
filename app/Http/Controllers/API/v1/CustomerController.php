<?php

namespace App\Http\Controllers\API\v1;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Payment;

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
      	$api_customer['due'] = $customer->invoices()->sum('invoice_amount');
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
       $payments = Payment::join('invoice').where('invoices.customer_id', $customer_id);
       return response()->json(['status' => 200, 'response' => $payments]);
    }
}