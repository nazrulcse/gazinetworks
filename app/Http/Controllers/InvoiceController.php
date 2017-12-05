<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Redirect;


class InvoiceController extends Controller
{
    public function index(Request $request){

        if($request->has('paid')){
            $invoices = Invoice::all()->where('is_paid', 1);
        }elseif($request->has('due')){
            $invoices = Invoice::all()->where('is_paid', 0);
        }else{
            $invoices = Invoice::all();
        }

        return view('invoices.index')->with('invoices', $invoices);
    }

    public function create(){

        $customers = Role::where('name','customer')->first()->users()->get()->pluck('customer_id', 'id');
        return view('invoices.create')->with('customers', $customers);

    }

    public function store(Request $request){

        $input = $request->all();
        $date = \Carbon\Carbon::now();
        $day = $date->day;
        $month_name = date("F", mktime(0, 0, 0, $request['month'], 15));
        $customer_bill = User::where('id', $request['customer_id'])->first()->customer_monthly_bill;
        $input['month'] = $month_name;
        $input['invoice_amount'] = $customer_bill;
        $input['date'] = $day;

        if(Invoice::where('customer_id', '=' ,$request['customer_id'])->where('month', '=' ,$month_name)->where('year', '=' ,$request['year'])->exists()){
            flash('Invoice already exists.')->info();
            return Redirect::to('invoices');

        }else{
            Invoice::create($input);
            flash('Invoice created')->success();
            return Redirect::to('invoices');
        }
    }

    public function show($id){

        $invoice = Invoice::find($id);
        $user = User::find($invoice->customer_id);
        return view('invoices.show')->with('invoice',$invoice)->with('user',$user);
    }

    public function edit($id){
        $invoice = Invoice::find($id);
        $month = date_parse($invoice->month);
        $month_number = ($month['month']);
        return view('invoices.edit')->with('invoice',$invoice)->with('month', $month_number);
    }

    public function update($id, Request $request){

        $invoice = Invoice::findOrFail($id);
        $input = $request->all();
        $month_name = date("F", mktime(0, 0, 0, $request['month'], 15));
        $input['month'] = $month_name;
        $invoice->fill($input)->save();
        flash('Invoice updated')->success();
        return Redirect::to('invoices');
    }

    public function destroy($id){

        $invoice = Invoice::find($id);
        $invoice->delete();

        flash('Invoice deleted')->success();
        return Redirect::to('invoices');
    }

}
