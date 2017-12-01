<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::all();
        return view('contacts.index')->with('contacts',$contacts);
    }

    public function destroy($id){

        $contact = Contact::find($id);
        $contact->delete();

        flash('Contact data deleted')->success();
        return Redirect::to('contacts');
    }
}
