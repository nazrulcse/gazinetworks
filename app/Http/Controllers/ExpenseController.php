<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\ExpenseCategory;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('expenses.index')->with('expenses', $expenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create')->with('category', $this->category());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'received_by' => 'required',
        ])->validate();

        $input = $request->all();
        $input['is_approved'] = true;
        $input['user_id'] = Auth::user()->id;
        $expense = Expense::create($input);
        if($expense) {
            return Redirect::to('expenses');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
       $expense = Expense::find($expense->id);
       return view('expenses.edit')->with(array('expense' => $expense, 'category' => $this->category()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $expense = Expense::find($expense->id);
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'received_by' => 'required',
        ])->validate();

        if($expense->fill($input)->save()) {
           return Redirect::to('expenses');
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
       $expense = Expense::find($expense->id);
       $expense->delete();
       return Redirect::to('expenses');
    }

    public function category() {
        $expense_category = array();
        $categories = ExpenseCategory::select('name')->pluck('name');
        foreach($categories as $key => $category) {
          $expense_category[$category] = $category;
        }
      return $expense_category;
    }
}
