<?php

namespace App\Http\Controllers\API\v2;

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
    public function index(Request $request)
    {
        $response = array();
        if ($request->has('q') && $request['q'] != '') {
            $all_customers = Role::where('name', 'customer')->first()->users();

            $customers = $all_customers
                ->where('name', 'LIKE', "%{$request['q']}%")
                ->orWhere('customer_id', 'LIKE', "%{$request['q']}%");
        } else {
            $customers = Role::where('name', 'customer')->first()->users();
        }

        if ($request->has('page')) {
            $customers = $customers->paginate(20);
        } else {
            $customers = $customers->get();
        }

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
}