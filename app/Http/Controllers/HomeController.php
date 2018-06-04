<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModel;
use App\News;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $newsModel =  new News;
        if (Auth::check()) {
            $news = $newsModel->getAllNews();
        } else {
            $news = $newsModel->getAllNewsPublic();;
        }
        return view('FO.home', array('imageUrl' => 'img/3.jpg', 'news' =>$news->first()));
    }

    public function presentation()
    {
        return view('FO.about', array('imageUrl' => 'img/Tujumi.jpg'));
    }

    public function indexPrestation()
    {
        $today          = Carbon::now();
        $nextEvents     = EventModel::where('categorie', '=', 'prestation')
                                ->where('start_time',  '>', Carbon::parse($today)->format('Y-m-d H:m:s'))
                                ->orderBy('start_time', 'desc')
                                ->get();

        $pastEvents     = EventModel::where('categorie', '=', 'prestation')
                                ->where('start_time',  '<', Carbon::parse($today)->format('Y-m-d H:m:s'))
                                ->orderBy('start_time', 'desc')
                                ->get();
        
        return view('FO.prestation', ['imageUrl' => 'img/event.JPG', "nextEvents" => $nextEvents, "pastEvents" => $pastEvents]);
    }

    public function indexProfil()
    {
        $user   = Auth::user();
        $events = $user->events;
    
        return view('FO.indexProfil', ['imageUrl' => 'img/event.JPG', 'user' => $user, 'events' => $events]);
    }

    public function updateProfil(Request $request)
    {
        $user   = Auth::user();
        if ($request->isMethod('post')) {
            $user->lastname    = $request->input('lastname');
            $user->firstname   = $request->input('firstname');
            $user->nickname    = $request->input('nickname');
            $user->email       = $request->input('email');
            $user->phonenumber = $request->input('phonenumber');
            $user->instrument  = $request->input('instrument');
            $user->lastname    = $request->input('lastname');
            $user->save();
            return redirect('/profil');
        } else {
            return view('FO.updateProfil', ['user' => $user]);
        }

    }
}
