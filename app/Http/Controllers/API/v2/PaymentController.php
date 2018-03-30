<?php

namespace App\Http\Controllers\API\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Invoice;
use Validator;
use DateTime;


class PaymentController extends Controller
{

    public $successStatus = 200;
    public $failureStatus = 100;

    public function index(Request $request)
    {
        if($request->has('receiver_id')){


            if ($request->has('q') && $request['q'] != '') {
                $payments = Payment::where('receiver_id', $request['receiver_id'])
                    ->whereHas('Invoice', function($query) use($request) {
                        $query->where('customer_id', '!=', 0);
                    })
                    ->whereHas('invoice.user', function($query) use($request){

                        $query->where('name', 'LIKE', '%'. $request['q'] .'%')
                            ->orWhere('customer_id', 'LIKE', '%'. $request['q'] .'%');

                    });
            }else{
                $payments = Payment::where('receiver_id', $request['receiver_id'])
                    ->whereHas('Invoice', function($query) use($request){

                        $query->where('customer_id','!=' , 0);
                    });
            }

            if ($request->has('page')) {
                $payments = $payments->paginate(20);
            } else {
                $payments = $payments->get();
            }

            if ($payments) {
                $response = array();
                foreach ($payments as $key => $payment) {
                    $row = array();
                    $row['id'] = $payment->id;
                    $row['customer_id'] = $payment->invoice->customer_id;
                    $row['name'] = $payment->invoice->user->name;
                    $row['month'] = $payment->invoice->month;
                    $row['invoice_amount'] = $payment->invoice->invoice_amount;
                    $row['amount'] = $payment->amount;
                    $row['date'] = $payment->created_at->format('Y-m-d');
                    $response[] = $row;
                }
                return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
            } else {
                $response['message'] = "Payments can't be received";
                return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
            }
        }else{
            $response['message'] = "There is no Receiver ID";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }


    public function other_income_payments(Request $request)
    {
        if($request->has('receiver_id')){


            $payments = Payment::where('receiver_id', $request['receiver_id'])
                ->whereHas('Invoice', function($query) use($request){

                    $query->where('customer_id','==' , 0);
                });


            if ($request->has('page')) {
                $payments = $payments->paginate(20);
            } else {
                $payments = $payments->get();
            }

            if ($payments) {
                $response = array();
                foreach ($payments as $key => $payment) {
                    $row = array();
                    $row['id'] = $payment->id;
                    $row['month'] = $payment->invoice->month;
                    $row['invoice_amount'] = $payment->invoice->invoice_amount;
                    $row['amount'] = $payment->amount;
                    $row['date'] = $payment->created_at->format('Y-m-d');
                    $response[] = $row;
                }
                return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
            } else {
                $response['message'] = "Payments can't be received";
                return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
            }
        }else{
            $response['message'] = "There is no Receiver ID";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }
}