<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
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
}
