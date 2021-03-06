<?php

namespace App\Http\Controllers;

use App\EventModel;
use App\Image;
use App\News;
use App\Services\MailGenerator;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\TokenRegister;


class AdminController extends Controller
{
    public function index()
    {
        return view('BO.index');
    }

    public function adminUser()
    {
    	if(!Auth::check() || Auth::user()->adminLevel <= 0)
		{
			return redirect('/');
		}
    	$userModel = new User;
    	$users = $userModel->getAllUsers();
    	return view('BO.Users.adminUser', ['users' => $users]);
    }

    public function adminNews()
    {
    	$newsModel = new News();
    	$news = $newsModel->getAllNews();

    	return view('BO.News.index', ['news' => $news]);
    }

    public function adminPrestation()
    {
        $eventModel = new EventModel();
        $events = $eventModel->getAllEvents();

    	return view('BO.Event.index', ['events' => $events]);
    }

    public function adminMedia()
    {
        $imgModel = new Image;

        $images = $imgModel->getAllImages();
        $categorie = [];
        foreach ($images as $key => $image) {
            $categorie[$image->categorie][$key] = $image;
        }

    	return view('BO.Media.index', ['categorie' => $categorie]);
    }

    public function upGradeAdminLevel($id)
    {
    	
        $user = User::find($id);
    	$user->adminLevel += 1;
    	$user->save();
    	return redirect('/admin/adminUser');
    }

    public function downGradeAdminLevel($id)
    {
    	$user = User::find($id);
    	$user->adminLevel -= 1;
    	$user->save();
    	return redirect('/admin/adminUser');
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

        MailGenerator::generateToken($token, $id, $email);

        return redirect('/admin/adminUser');
    }
}
