<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
    	return view('contact', ['imageUrl' => 'img/contact.JPG']);
    }

    public function send(Request $request) {
      
      $name        = $request->input('name');
      $phoneNumber = $request->input('phonenumber');
      $email       = $request->input('email');
      $msg         = $request->input('message');
      
        
      Mail::send('email.sendContact', ['name' => $name, "phoneNumber" => $phoneNumber, 'email' => $email, 'msg' => $msg], function($message)
        {
            $message->from('contact@bandatujumi.fr', 'Banda Tujumi');
            $message->to('alex.depem@gmail.com');
            $message->subject('Prise de contact Banda Tujumi');
        });
      \Session::flash('flash_message', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus bref délais.');
      return redirect('/contact');
    }
}
