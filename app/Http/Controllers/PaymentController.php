<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Invoice;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function index(){
        $payments = Payment::all();
        return view('payments.index')->with('payments', $payments);

    }

    public function store(Request $request){

//        dd($request->toArray());

        $input = $request->all();
        $invoice = Invoice::find($request->invoice);
        $input['invoice_id'] = $request->invoice;
        $receiver = Auth::user()->id;
        $input['receiver_id'] = $receiver;
        $input['amount'] = $request->amount;

        $dt =  new DateTime();
        $input['date'] = $dt;



        $pay = Payment::create($input);

        if($pay){

            $total_pay = $invoice->payments->sum('amount');

            if($total_pay >= $invoice->invoice_amount) {
                $invoice->update(array('is_paid'=> 1));
            }

            flash('Bill Collected')->success();
            return Redirect::back();
        }


    }


    public function destroy($id){

        $paymnet = Payment::find($id);
        Invoice::find($paymnet->invoice_id)->update(array('is_paid' => 0));
        $paymnet->delete();

        flash('Payment deleted')->success();
        return Redirect::back();

    }
}
