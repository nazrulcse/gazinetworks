<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Role;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $date = \Carbon\Carbon::now();
        $month_name = $date->day;
        dd($month_name);


        if($request->has('agents')){
            $users = Role::where('name','agent')->first()->users()->get();
        }elseif($request->has('customers')){
            $users = Role::where('name','customer')->first()->users()->get();
        }else{
            $users = User::all();
        }

        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {

        $input = $request->all();
        $input['customer_is_free'] = $request->has('customer_is_free') ? 1 : 0;
        $input['customer_set_top_box_iv'] = $request->has('customer_set_top_box_iv') ? 1 : 0;
        $input['customer_status'] = $request->has('customer_status') ? 1 : 0;

        if ($request->has('customer_tv_count')){
            $input['customer_id'] = 'C'.$request['customer_road'].$request['customer_house'].$request['customer_flat'].rand(10, 99);

        }else{
            $input['customer_id'] = 'A'.rand(10000, 99999);
        }

        $input['password'] = bcrypt($input['customer_id']);

        $image=$request->file('image');
        if($image){
            $image_name=str_random(20);
            $text=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$text;
            $upload_path='uploads/user_image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success){
                $input['image']=$image_url;
                $user = User::create($input);
            }
        }
        else{
            $user = User::create($input);
        }

        if ($request->has('customer_tv_count')){
            $user->attachRole(Role::where('name','customer')->first());
            flash('Customer created')->success();
            return Redirect::to('users?customers');
        }else{
            $user->attachRole(Role::where('name','agent')->first());
            flash('Agent created')->success();
            return Redirect::to('users?agents');
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show')->with('user',$user);
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user',$user);
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        $input['customer_is_free'] = $request->has('customer_is_free') ? 1 : 0;
        $input['customer_set_top_box_iv'] = $request->has('customer_set_top_box_iv') ? 1 : 0;
        $input['customer_status'] = $request->has('customer_status') ? 1 : 0;

        $image=$request->file('image');
        if($image){
            $image_name=str_random(20);
            $text=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$text;
            $upload_path='uploads/user_image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success){
                $input['image']=$image_url;
                $user->fill($input)->save();
            }
        }
        else{
            $user->fill($input)->save();
        }

        if ($request->has('customer_id')){
            flash('Customer updated')->success();
            return Redirect::to('users?customers');
        }else{
            flash('Agent updated')->success();
            return Redirect::to('users?agents');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        // redirect
        flash('Record deleted')->success();
        return redirect()->back();
    }

}

