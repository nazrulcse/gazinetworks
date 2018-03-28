<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use DateTime;


class InvoiceController extends Controller
{
    public function index(Request $request){

        $status_array = array();

        if($request->has('paid')){
            $invoices = Invoice::where('is_paid', 1)->where('customer_id','!=' , 0)->paginate(50);
            array_push($status_array, 1);
        }elseif($request->has('due')){
            $invoices = Invoice::where('is_paid', 0)->where('customer_id','!=' , 0)->paginate(50);
            array_push($status_array, 0);
        }else{
            $invoices = Invoice::where('customer_id','!=' , 0)->paginate(50);
            array_push($status_array, 0,1);
        }

        if($request->q) {
            $invoices = Invoice::whereIn('is_paid', $status_array)->where('customer_id','!=' , 0)
                ->whereHas('User', function($query) use($request){

                    $query->where('name', 'LIKE', '%'. $request['q'] .'%')
                        ->orWhere('customer_id', 'LIKE', '%'. $request['q'] .'%');

                })->paginate(50);
        }

        return view('invoices.index')->with(array('invoices' => $invoices, 'search' => $request->q));
    }

    public function create(){

        $customers = Role::where('name','customer')->first()->users()->get()->pluck('customer_id', 'id');
        return view('invoices.create')->with('customers', $customers);

    }

    public function store(Request $request){

        $input = $request->all();
        $date = DateTime::createFromFormat("d-m-Y", $input['invoice_date']);
        $month_name = date("F", mktime(0, 0, 0, $date->format("m"), 15));
        $input['date'] = $date->format("d");
        $input['month'] = $month_name;
        $input['year'] = $date->format("Y");

        if ($request->has('customer_id')){

            $customer_bill = User::where('id', $request['customer_id'])->first()->customer_monthly_bill;
            $input['invoice_amount'] = $customer_bill;


            if(Invoice::where('customer_id', '=' ,$request['customer_id'])->where('month', '=' ,$input['month'])->where('year', '=' ,$input['year'])->exists()){
                flash('Invoice already exists.')->info();
                return Redirect::to('invoices');

            }else{
                Invoice::create($input);
                flash('Invoice created')->success();
                return Redirect::to('invoices');
            }
        }else{
            Invoice::create($input);
            flash('Invoice created')->success();
            return Redirect::to('other_income_invoices');
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

        $date = new DateTime($invoice->date.'-'.$month_number.'-'.$invoice->year);
        $formatted_date = $date->format('d-m-Y');
        return view('invoices.edit')->with('invoice',$invoice)->with('formatted_date', $formatted_date);
    }

    public function update($id, Request $request){

        $invoice = Invoice::findOrFail($id);
        $input = $request->all();
        $date = DateTime::createFromFormat("d-m-Y", $input['invoice_date']);
        $month_name = date("F", mktime(0, 0, 0, $date->format("m"), 15));
        $input['date'] = $date->format("d");
        $input['month'] = $month_name;
        $input['year'] = $date->format("Y");
        $invoice->fill($input)->save();
        flash('Invoice updated')->success();
        if ($request->has('other')){
            return Redirect::to('other_income_invoices');
        }else{
            return Redirect::to('invoices');
        }

    }

    public function destroy($id){

        $invoice = Invoice::find($id);
        $invoice->delete();

        flash('Invoice deleted')->success();
        return Redirect::to('invoices');
    }

    public function invoice_report(Request $request) {
        $start_date = $request->sdate ? $request->sdate : date('Y-m-01');
        $end_date = $request->edate ? $request->edate : date("Y-m-d");
        $status = $request->status ? (int)$request->status : 0;
        $g_invoice = $this->graph_invoice($start_date, $end_date);
        $invoices = Invoice::whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), array($start_date, $end_date))->where('is_paid', $status)->paginate(50);
        return view('invoices.report')->with(array('invoice_data' => $g_invoice, 'sdate' => $start_date, 'edate' => $end_date, 'invoices'=> $invoices));
    }

    public function graph_invoice($start_date, $end_date) {
        $g_invoice = array('unpaid' => 0, 'paid' => 0, 'partial' => 0, 'total_amount' => 0, 'total_paid' => 0);
        $invoices = Invoice::whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), array($start_date, $end_date))->get();
        $g_invoice['total_amount'] = $invoices->sum('invoice_amount');
        $g_invoice['total_invoice'] = $invoices->count() > 0 ? $invoices->count() : 1;
        foreach($invoices as $key => $invoice) {
            $paid = $invoice->payments->sum('amount');
            $g_invoice['total_paid'] += $paid;
            if($paid >= $invoice->invoice_amount) {
                $g_invoice['paid'] += 1;
            }
            else if($paid > 0) {
                $g_invoice['partial'] += 1;
            }
            else {
                $g_invoice['unpaid'] += 1;
            }
        }

        $g_invoice['paid_per'] = round(($g_invoice['paid'] / $g_invoice['total_invoice']) * 100.0, 2);
        $g_invoice['unpaid_per'] = round(($g_invoice['unpaid'] / $g_invoice['total_invoice']) * 100.0, 2);
        $g_invoice['partial_per'] = round(($g_invoice['partial'] / $g_invoice['total_invoice']) * 100.0, 2);
        return $g_invoice;
    }

    public function other_income_invoices(){
        $invoices = Invoice::where('customer_id', 0)->paginate(50);
        return view('invoices.other_income_invoice_list')->with(array('invoices' => $invoices));

    }


}
