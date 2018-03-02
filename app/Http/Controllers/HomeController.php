<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complain;
use App\Payment;
use App\Invoice;
use App\Expense;
use App\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->year = date("Y");
        $this->month = date("m");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $g_invoice = $this->graph_invoice();
        $recent_invoice = Invoice::whereRaw('YEAR(created_at) = ? and MONTH(created_at) = ?', array($this->year, $this->month))->limit(5)->get();
        return view('dashboard')->with(array('invoice_data' => $g_invoice, 'recent_invoices' => $recent_invoice));
    }

    public function graph_inex() {
      $graph_income = $this->initArray(0,31);
      $graph_expense = $this->initArray(0,31);

      $payments = $this->income()->groupBy(function($item) {
          if($item->date) {
            $parse_date = date_parse($item->date);
            return $parse_date['day'];
          }
          else {
            return $item->created_at->day;
          }
      });
      foreach ($payments as $key => $payment) {
          $graph_income[$key] = $payment->sum('amount');
      }

      $expenses = $this->expense()->groupBy(function($item) {
          if($item->date) {
            $parse_date = date_parse($item->date);
            return $parse_date['day'];
          }
          else {
            return $item->created_at->day;
          }
      });
      foreach ($expenses as $key => $expense) {
          $graph_expense[$key] = $expense->sum('amount');
      }

      return response()->json(['income' => $graph_income, 'expense' => $graph_expense]);
    }

    public function graph_income_expense() {
      $total_income = $this->income()->sum('amount');
      $total_expense = $this->expense()->sum('amount');
      return response()->json(['income' => $total_income, 'expense' => $total_expense]);
    }

    public function graph_expense() {
      $g_expense = array();
      $expenses = $this->expense()->groupBy(function($item) {
                    return $item->category;
      });
      foreach($expenses as $key => $expense) {
         $g_expense[] = array('y' => $expense->sum('amount') , 'label' => $key);
      }
      return response()->json(['graph_data' => $g_expense]);
    }

    public function graph_invoice() {
      $g_invoice = array('unpaid' => 0, 'paid' => 0, 'partial' => 0, 'total_amount' => 0, 'total_paid' => 0);
      $invoices = $this->invoice();
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

    public function connection($year) {
        $graph_connection = $this->initArray(1, 12);
        $customers = Role::where('name','customer')->first()->users();
        $customers = $customers->whereRaw('YEAR(created_at) = ?', $year)->get()->groupBy(function($item) {
          return $item->created_at->month;
        });
        foreach ($customers as $key => $customer) {
          $graph_connection[$key] = $customer->count();
        }
       return $graph_connection;
    }

    public function initArray($from, $to) {
      $monthly_graph = array();
      for($i = $from; $i <= $to; $i++) {
        $monthly_graph[] = 0;
      }
      return $monthly_graph;
    }

    public function income() {
      return Payment::whereRaw('YEAR(date) = ? and MONTH(date) = ?', array($this->year, $this->month))->get();
    }

    public function expense() {
      return Expense::whereRaw('YEAR(date) = ? and MONTH(date) = ?', array($this->year, $this->month))->get();
    }

    public function invoice() {
      return Invoice::whereRaw('YEAR(created_at) = ? and MONTH(created_at) = ?', array($this->year, $this->month))->get();
    }
}
