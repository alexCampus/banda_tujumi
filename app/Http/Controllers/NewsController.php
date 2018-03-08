<?php

namespace App\Http\Controllers;

use App\Services\MailGenerator;
use Illuminate\Http\Request;
use App\News;
use Carbon\Carbon;
use Auth;

class NewsController extends Controller
{
    public function index() {
    	$newsModel =  new News;
    	if (Auth::check()) {
    	    $news = $newsModel->getAllNews();
        } else {
            $news = $newsModel->getAllNewsPublic();;
        }

    	return view('actualites', ['news' => $news, 'imageUrl' => 'img/actu.jpg']);
    }

    public function create() {
    	return view('admin.createNews');
    }

    public function store(Request $request)
    {
    	$new = new News;
    	$new->title     = $request->input('title');
    	$new->content   = $request->input('content');
    	$new->isPrivate = $request->get('isPrivate');
    	$new->date      = Carbon::now('Europe/London');
    	$new->save();
//@TODO Generer email lors de la creation de news prive
//    	if ($request->get('isPrivate') === 1) {
//            MailGenerator::prestationMail($this->eventModel, $request);
//        }
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
        if ($request->get('isPrivate')) {
            $news->isPrivate = $request->get('isPrivate');
        }
        $news->date = Carbon::now('Europe/London');
        $news->save();
        return redirect('/actualites');
    }        
}
