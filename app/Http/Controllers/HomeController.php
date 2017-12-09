<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complain;
use App\Role;
use Illuminate\Support\Facades\DB;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = date("Y");
        $graph_complain = $this->initArray();
        $complains = Complain::whereRaw('YEAR(created_at) = ?', $year)->get()->groupBy(function($item) {
          return $item->created_at->month;
        });
        foreach ($complains as $key => $complain) {
          $graph_complain[$key] = $complain->count();
        }
        $graph_connection = $this->connection($year);
        return view('dashboard')->with('dashboard', 
            array('complain' => json_encode($graph_complain), 'connection' => json_encode($graph_connection))
        );
    }

    public function connection($year) {
        $graph_connection = $this->initArray();
        $customers = Role::where('name','customer')->first()->users();
        $customers = $customers->whereRaw('YEAR(created_at) = ?', $year)->get()->groupBy(function($item) {
          return $item->created_at->month;
        });
        foreach ($customers as $key => $customer) {
          $graph_connection[$key] = $customer->count();
        }
       return $graph_connection;
    }

    public function initArray() {
      $monthly_graph = array();
      for($i = 1; $i <= 12; $i++) {
        $monthly_graph[] = 0;
      }
      return $monthly_graph;
    }
}
