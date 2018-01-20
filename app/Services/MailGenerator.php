<?php

namespace App\Services;


use App\User;
use Illuminate\Support\Facades\Mail;

class MailGenerator
{

    static function prestationMail($event, $request)
    {
        if ($request->path() === 'createEvent') {
            $subject   = 'Une nouvelle prestation vient d\'etre ajouter sur le site banda tujumi';
            $typeEmail = 'email.newPrestation';
            $url       = "http://localhost:8000/agenda/" . $event->id;
            $users     = User::all();
        } elseif ($request->path() === 'updateEvent/' . $event->id) {
            $subject   = 'Une prestation vient d\'etre mise a jour sur le site banda tujumi';
            $typeEmail = 'email.updatePrestation';
            $url       = "http://localhost:8000/agenda/" . $event->id;
            $users     = $event->users;
        } elseif ($request->path() === 'deleteEvent/' . $event->id) {
            $subject   = 'Une prestation vient d\'etre retire sur le site banda tujumi';
            $typeEmail = 'email.deletePrestation';
            $url       = "http://localhost:8000/agenda/";
            $users     = $event->users;
        }



        if ($users) {
            foreach($users as $user) {
                $email = $user->email;
                Mail::send($typeEmail, ['url' => $url], function ($message) use ($email, $subject) {
                    $message->from('admin@lelabobois.fr', 'Banda Tujumi');
                    $message->to($email);
                    $message->subject($subject);
                });
            }
        }
    }

    static function generateToken($token, $id,$email)
    {
        $url ="http://localhost:8000/register?token=" . $token . "&id=" . $id;

        Mail::send('email.sendToken', ['url' => $url], function($message) use ($email)
        {
            $message->from('admin@lelabobois.fr', 'Banda Tujumi');
            $message->to($email);
            $message->subject('Creation de votre compte sur le site banda tujumi');
        });
    }
}