<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Role;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {

        $input = $request->all();
        $image=$request->file('image');
        if($image){
            $image_name=str_random(20);
            $text=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$text;
            $upload_path='user_image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success){
                $input['image']=$image_url;
                $user = User::create($input);
                return redirect()->back();
            }
        }
        else{
            $user = User::create($input);
            return redirect()->back();
        }


        $user = User::create($input);

        if ($request->has('customer_id')){
            $user->attachRole(Role::where('name','customer')->first());
        }else{
            $user->attachRole(Role::where('name','agent')->first());
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

        $user->fill($input)->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to('users');
    }

}

