<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Invoice;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * @param Request $request
     * @return $this|string
     */
    public function index(Request $request){

        if($request->ajax()){

            $dateRange =  $request["dateRange"];
            $dates = explode(' - ', $dateRange);
            $start_date = Carbon::createFromFormat('d/m/Y', $dates[0])->startOfDay();
            $end_date = Carbon::createFromFormat('d/m/Y', $dates[1])->endOfDay();

            $payments = Payment::whereBetween('created_at', [$start_date, $end_date])->get();
            $pay_view = view('payments._payment_table')->with('payments', $payments)->render();
            return $pay_view;

            \Log::info($payments);


        }else{

            $payments = Payment::all();
            return view('payments.index')->with('payments', $payments);

        }

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
