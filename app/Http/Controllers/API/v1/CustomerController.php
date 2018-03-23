<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Payment;
use App\Invoice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function index(Request $request){
      $response = array();
      if ($request->has('q') && $request['q'] != ''){
          $all_customers = Role::where('name','customer')->first()->users();

          $customers = $all_customers
              ->where('name', 'LIKE', "%{$request['q']}%")
              ->orWhere('customer_id', 'LIKE', "%{$request['q']}%");
      }else{
          $customers = Role::where('name','customer')->first()->users();
      }

      if($request->has('page')) {
          $customers = $customers->paginate(20);
      }else{
          $customers = $customers->get();
      }

      foreach ($customers as $key => $customer) {
      	$api_customer = array();
      	$api_customer['id'] = $customer->id;
      	$api_customer['customer_id'] = $customer->customer_id;
      	$api_customer['name'] = "{$customer->name} ({$customer->customer_id})";
      	$api_customer['address'] = $customer->address;
      	$api_customer['mobile'] = $customer->phone;
      	$api_customer['tv'] = $customer->customer_tv_count;
      	$api_customer['due'] = $customer->total_due();
      	$response[$key] = $api_customer;
      }
      return response()->json(['status' => 200, 'response' => $response]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'customer_id' => 'unique:users|required|string|'
        ]);
        if ($validator->fails()) {
            $response = $validator->errors()->first();
            return response()->json(['status' => 500, 'response' => $response]);
        }

        $input = $request->all();
        $input['customer_is_free'] = $request->has('customer_is_free') ? 1 : 0;
        $input['customer_set_top_box_iv'] = $request->has('customer_set_top_box_iv') ? 1 : 0;
        $input['customer_status'] = $request->has('customer_status') ? 1 : 0;
        $input['customer_connection_date'] = date('Y-m-d', strtotime($request['customer_connection_date']));
        $input['password'] = bcrypt($input['phone']);

        $user = User::create($input);

        if(($user)){
            $user->attachRole(Role::where('name','customer')->first());
            $response = "Customer created successfully";
            $id = $user->id;
            return response()->json(['status' => 200, 'response' => $response, 'id'=> $id]);
        }else{
            $response = "Customer can't be created";
            return response()->json(['status' => 100, 'response' => $response]);
        }

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