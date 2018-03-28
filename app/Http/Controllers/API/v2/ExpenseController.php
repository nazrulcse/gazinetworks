<?php

namespace App\Http\Controllers\API\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Expense;
use App\ExpenseCategory;
use Validator;
use App\User;
use DateTime;
use Illuminate\Support\Carbon;

class ExpenseController extends Controller
{

    public $successStatus = 200;
    public $failureStatus = 500;

    /*public function index(Request $request)
    {
        if($request->has('id')){

            if ($request->has('date') && $request['date'] != '') {
                $date = Carbon::createFromFormat('d/m/Y', $request['date'])->startOfDay();
                $expenses = Expense::where('user_id', $request['id'])
                    ->where('date', $date);
            }else{
                $expenses = Expense::where('user_id', $request['id']);
            }

            if ($request->has('page')) {
                $expenses = $expenses->paginate(20);
            } else {
                $expenses = $expenses->get();
            }

            if ($expenses) {
                $response = array();
                foreach ($expenses as $key => $expense) {
                    $row = array();
                    $row['title'] = $expense->title;
                    $row['amount'] = $expense->amount;
                    $row['category'] = $expense->id;
                    $row['expense_by'] = $expense->user->name;
                    $row['amount'] = $expense->amount;
                    $row['date'] = $expense->date->format('Y-m-d');
                    $response[] = $row;

                }
                return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
            } else {
                $response['message'] = "Payments can't be received";
                return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
            }

        }else{
            $response['message'] = "There is no User ID";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);

        }
    }*/

    public function index(Request $request)
    {
        if($request->has('id')){

            if ($request->has('date') && $request['date'] != '') {
                $date = Carbon::createFromFormat('d/m/Y', $request['date'])->startOfDay();
                $expenses = Expense::where('user_id', $request['id'])
                    ->where('date', $date);
            }else{
                $expenses = Expense::where('user_id', $request['id']);
            }

            if ($request->has('page')) {
                $expenses = $expenses->paginate(20);
            } else {
                $expenses = $expenses->get();
            }

            if ($expenses) {
                $response = array();
                foreach ($expenses as $key => $expense) {
                    $row = array();
                    $row['title'] = $expense->title;
                    $row['amount'] = $expense->amount;
                    $row['category'] = $expense->id;
                    $row['expense_by'] = $expense->user->name;
                    $row['amount'] = $expense->amount;
                    $row['date'] = $expense->date;
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