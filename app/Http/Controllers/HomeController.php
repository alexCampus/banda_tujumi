<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModel;
use App\News;
use Auth;

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
        return view('home', array('imageUrl' => 'img/accueil.jpg', 'news' =>$news));
    }

    public function presentation()
    {
        return view('about', array('imageUrl' => 'img/Tujumi.jpg'));
    }

    public function indexPrestation()
    {
        $events     = EventModel::where('categorie', '=', 'prestation')->orderBy('start_time', 'desc')->get();
        
        return view('/prestation', ['imageUrl' => 'img/event.JPG', "events" => $events]);
    }

    public function indexProfil()
    {
        $user = Auth::user();
        return view('/indexProfil', ['imageUrl' => 'img/event.JPG', 'user' => $user]);
    }
}
