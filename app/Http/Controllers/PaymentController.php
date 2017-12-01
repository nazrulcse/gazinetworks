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

        $input = $request->all();
        $input['invoice_id'] = $request->invoice;
        $receiver = Auth::user()->id;
        $input['receiver_id'] = $receiver;
        $dt =  new DateTime();
        $input['date'] = $dt;

        $pay = Payment::create($input);

        if($pay){
            Invoice::where('id', $request['invoice'])->update(array('status' => 1));
            flash('Payment created')->success();
            return Redirect::back();
        }


    }


    public function destroy($id){

        $paymnet = Payment::find($id);
        Invoice::where('id', $paymnet->invoice_id)->update(array('status' => 0));
        $paymnet->delete();

        flash('Payment deleted')->success();
        return Redirect::to('payments');

    }
}
