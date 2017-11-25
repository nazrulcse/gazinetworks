<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

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

        User::create($input);

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

