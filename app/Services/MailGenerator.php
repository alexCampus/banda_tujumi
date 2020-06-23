<?php

namespace App\Services;


use App\User;
use Illuminate\Support\Facades\Mail;

class MailGenerator
{

    static function prestationMail($event, $request)
    {
        if ($request->path() === 'createEvent') {
            $subject   = 'Une nouvelle prestation vient d\'etre mise sur le site banda tujumi';
            $typeEmail = 'email.newPrestation';
            $url       = "https://www.banda-tujumi.fr/agenda/" . $event->id;
            $users     = User::where('adminLevel', '>=', 0)->get();
        } elseif ($request->path() === 'updateEvent/' . $event->id) {
            $subject   = 'Une prestation vient d\'etre mise a jour sur le site banda tujumi';
            $typeEmail = 'email.updatePrestation';
            $url       = "https://www.banda-tujumi.fr/agenda/" . $event->id;
            $users     = $event->users;
        } elseif ($request->path() === 'deleteEvent/' . $event->id) {
            $subject   = 'Une prestation vient d\'etre retire sur le site banda tujumi';
            $typeEmail = 'email.deletePrestation';
            $url       = "https://www.banda-tujumi.fr/agenda/";
            $users     = $event->users;
        } elseif ($request->path() === 'createNews') {
            $subject   = 'Une nouvelle actu vient d\'etre mise sur le site banda tujumi';
            $typeEmail = 'email.newActualite';
            $url       = "https://www.banda-tujumi.fr/actualites/";
            $users     = User::where('adminLevel', '>=', -1)->get();
        } elseif ($request->path() === 'comment/' . $event->id) {
            $subject   = 'Un nouveau commentaire vient d\'etre posté sur le site banda tujumi';
            $typeEmail = 'email.newActualite';
            $url       = "https://www.banda-tujumi.fr/agenda/" . $event->id;
            $users     = User::getAllAdminUsers();
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
        $url ="https://www.banda-tujumi.fr/register?token=" . $token . "&id=" . $id;

        Mail::send('email.sendToken', ['url' => $url], function($message) use ($email)
        {
            $message->from('admin@lelabobois.fr', 'Banda Tujumi');
            $message->to($email);
            $message->subject('Creation de votre compte sur le site banda tujumi');
        });
    }

    static function newUser($firstname, $lastname)
    {
        $email = 'alex.depem@hotmail.fr';

        Mail::send('email.newUser',['firstname' => $firstname, 'lastname' => $lastname], function($message) use ($email)
        {
            $message->from('admin@lelabobois.fr', 'Banda Tujumi');
            $message->to($email);
            $message->subject('Un nouvel utilisateur vient de créer son compte');
        });
    }
}