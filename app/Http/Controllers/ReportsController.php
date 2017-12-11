<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Invoice;
use App\Expense;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function income(Request $request) {
        $start_date = $request->sdate ? $request->sdate : date('Y-m-01');
        $end_date = $request->edate ? $request->edate : date("Y-m-d");
        $graph_data = array();
        $graph_label = array();
        $payments = Payment::whereBetween(DB::raw('DATE_FORMAT(date, "%Y-%m-%d")'), array($start_date, $end_date))->get();
        $total = $payments->sum('amount');
        $g_payments = $payments->groupBy(function($item) {
             return date('Y-m-d', strtotime($item->date));
        });
        foreach($g_payments as $key => $payment) {
          $graph_data[] = $payment->sum('amount');
          $graph_label[] = $key;
        } 
        return view('reporting.income')->with(array('payments' => $payments, 'graph_data' => json_encode($graph_data), 'graph_label' => json_encode($graph_label), 'sdate' => $start_date, 'edate' => $end_date, 'total' => $total));
    }

    public function expense(Request $request){
        $start_date = $request->sdate ? $request->sdate : date('Y-m-01');
        $end_date = $request->edate ? $request->edate : date("Y-m-d");
        $graph_data = array();
        $graph_label = array();
        $expenses = Expense::whereBetween(DB::raw('DATE_FORMAT(date, "%Y-%m-%d")'), array($start_date, $end_date))->get();
        $total = $expenses->sum('amount');
        $g_expenses = $expenses->groupBy(function($item) {
             return date('Y-m-d', strtotime($item->date));
        });
        foreach($g_expenses as $key => $expense) {
          $graph_data[] = $expense->sum('amount');
          $graph_label[] = $key;
        } 
        return view('reporting.expense')->with(array('expenses' => $expenses, 'graph_data' => json_encode($graph_data), 'graph_label' => json_encode($graph_label), 'sdate' => $start_date, 'edate' => $end_date, 'total' => $total));
    }


    public function balance($id){

        $paymnet = Payment::find($id);
        Invoice::find($paymnet->invoice_id)->update(array('is_paid' => 0));
        $paymnet->delete();

        flash('Payment deleted')->success();
        return Redirect::back();

    }
}
