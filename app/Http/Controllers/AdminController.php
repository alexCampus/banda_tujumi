<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

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

    public function upGradeAdminLevel()
    {
    	
    	$user = Auth::user();
    	$user->adminLevel += 1;
    	$user->save();
    	return redirect('/adminUser');
    }

    public function downGradeAdminLevel()
    {
    	
    	$user = Auth::user();
    	$user->adminLevel -= 1;
    	$user->save();
    	return redirect('/adminUser');
    }
}
