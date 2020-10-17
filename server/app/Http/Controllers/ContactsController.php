<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function store(){
        Contact::create($this->valiedateData());
    }

    public function show(Contact $contact){
        return $contact;
    }

    public function update(Contact $contact){
        $contact->update(
            $this->valiedateData()
        );
    }

    public function destroy(Contact $contact){
        $contact->delete();
    }

    private function valiedateData(){

        return request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => 'required',
            'company' => 'required',
        ]);
    }
}
