<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Expense;
use App\ExpenseCategory;
use App\User;

class ExpenseController extends Controller{

    public $successStatus = 200;
    public $failureStatus = 100;

    public function new(){
        $payments = ExpenseCategory::all();
        return response()->json(['status' => $this->successStatus, 'response' => $payments]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'received_by' => 'required',
        ]);

        if ($validator->fails()) {
          return response()->json(['status' => $this->failureStatus, 'response' => $validator->messages()]);
        }
        else {
            $input = $request->all();
            $expense = Expense::create($input);
            if($expense) {
                return response()->json(['status' => $this->successStatus, 'response' => 'Expense created successfully']);
            }
            else {
             return response()->json(['status' => $this->failureStatus, 'response' => 'Unable to create expense']);   
            }
        }
    }
}