<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\TokenRegister;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
    	if(!Auth::check() || Auth::user()->adminLevel != 3) 
		{
			return redirect('/');
		}
    	$userModel = new User;
    	$users = $userModel->getAllUsers();
    	return view('admin.adminUser', ['users' => $users]);
    }

    public function upGradeAdminLevel($id)
    {
    	
        $user = User::find($id);
    	$user->adminLevel += 1;
    	$user->save();
    	return redirect('/adminUser');
    }

    public function downGradeAdminLevel($id)
    {
    	$user = User::find($id);
    	$user->adminLevel -= 1;
    	$user->save();
    	return redirect('/adminUser');
    }

    public function newUser(Request $request)
    {
        $token         = str_random(60);
        $email         = $request->input('email'); 
        $tokenRegister = new TokenRegister;
        $tokenRegister->token = $token;
        $tokenRegister->email = $email;
        $tokenRegister->save();

        $id = $tokenRegister->getId();
        $url ="http://localhost:8000/register?token=" . $token . "&id=" . $id;
        Mail::send('email.sendToken', ['url' => $url], function($message) use ($email)
        {
            $message->from('admin@lelabobois.fr', 'Banda Tujumi');
            $message->to($email);
            $message->subject('Creation de votre compte sur le site banda tujumi');
        });

        return redirect('/adminUser');
    }
}
