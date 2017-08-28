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

    public function viewUpdate($id) {

        $newsModel = new News;
        $news      = $newsModel->getOneNews($id);

        return view('updateNews', ['news' => $news]);
    }

    public function update($id, Request $request) {

        $newsModel = new News;
        $news      = $newsModel->getOneNews($id);

        if ($request->input('title')) {
            $news->title = $request->input('title');
        }

        if ($request->input('content')) {
            $news->content = $request->input('content');
        }
        $news->date = Carbon::now('Europe/London');
        $news->save();
        return redirect('/actualites');
    }        
}
