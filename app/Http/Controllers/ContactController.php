<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('FO.contact', ['imageUrl' => 'img/contact.JPG']);
    }

    public function send(Request $request) 
    {
        $data = [
            "secret"   => "6Ldp0dEUAAAAAOq1TlouG6Qu-7IqTTZYVxQ3yx14",
            'response' => $request->get('g-recaptcha-response')
        ];

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        $response = json_decode($response);
        if ($response->success) {
            $name        = $request->input('name');
            $phoneNumber = $request->input('phonenumber');
            $email       = $request->input('email');
            $msg         = $request->input('message');


            Mail::send(
                'email.sendContact',
                ['name' => $name, "phoneNumber" => $phoneNumber, 'email' => $email, 'msg' => $msg],
                function ($message) {
                    $message->from('admin@lelabobois.fr', 'Banda Tujumi');
                    $message->to('alex.depem@gmail.com');
                    $message->subject('Prise de contact Banda Tujumi');
                }
            );
            \Session::flash('flash_message', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus bref délais.');
        }

        return redirect('/contact');
    }
}
