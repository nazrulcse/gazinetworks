<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = ExpenseCategory::all();
        return view('expense_categories.index')->with('expense_categories', $expenses);
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
            'name' => 'required'
        ])->validate();

        $input = $request->all();
        $expense_categorie = ExpenseCategory::create($input);
        if($expense_categorie) {
            return Redirect::to('expense_categories');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $expense_category = ExpenseCategory::find($id);
       return view('expense_categories.edit')->with('expense_category', $expense_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expense_category = ExpenseCategory::find($id);
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ])->validate();

        if($expense_category->fill($input)->save()) {
           return Redirect::to('expense_categories');
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
    public function destroy($id)
    {
       $expense_category = ExpenseCategory::find($id);
       $expense_category->delete();
       return Redirect::to('expense_categories');
    }
}
