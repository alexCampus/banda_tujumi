<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModel;
use App\News;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsModel =  new News;
        $news = $newsModel->getAllNews();
        return view('home', array('imageUrl' => 'img/3.jpg', 'news' =>$news));
    }

    public function presentation()
    {
        return view('about', array('imageUrl' => 'img/Tujumi.jpg'));
    }

    public function indexPrestation()
    {
        $today      = Carbon::now();
        $nextEvents     = EventModel::where('categorie', '=', 'prestation')
                                ->where('start_time',  '>', Carbon::parse($today)->format('Y-m-d H:m:s'))
                                ->orderBy('start_time', 'desc')
                                ->get();

        $pastEvents     = EventModel::where('categorie', '=', 'prestation')
                                ->where('start_time',  '<', Carbon::parse($today)->format('Y-m-d H:m:s'))
                                ->orderBy('start_time', 'desc')
                                ->get();
        
        return view('/prestation', ['imageUrl' => 'img/event.JPG', "nextEvents" => $nextEvents, "pastEvents" => $pastEvents]);
    }

    public function indexProfil()
    {
        $user   = Auth::user();
        $events = $user->events;
    
        return view('/indexProfil', ['imageUrl' => 'img/event.JPG', 'user' => $user, 'events' => $events]);
    }
}
