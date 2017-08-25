<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function index() {
    	$news =  new News;
    	
    	return view('actualites', ['news' => $news->getAllNews(), 'imageUrl' => 'img/actu.jpg']);
    }

    public function create() {
    	return view('admin.createNews');
    }

    public function store(Request $request) {

    	$new = new News;
    	$new->title   = $request->input('title');
    	$new->content = $request->input('content');
    	$new->date    = Carbon::now('Europe/London');
    	$new->save();
    	return redirect('/actualites');
    }  
}
