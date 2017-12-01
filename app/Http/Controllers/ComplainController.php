<?php

namespace App\Http\Controllers;

use App\Complain;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    public function index(){
        $complains = Complain::all();
        return view('complains.index')->with('complains',$complains);
    }

    public function destroy($id){

        $contact = Contact::find($id);
        $contact->delete();

        flash('Complain data deleted')->success();
        return Redirect::to('complains');
    }
}
