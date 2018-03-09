<?php

namespace App\Http\Controllers;

use App\Services\MailGenerator;
use Illuminate\Http\Request;
use App\News;
use Carbon\Carbon;
use Auth;

class NewsController extends Controller
{
    private $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

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
    	$this->news->title     = $request->input('title');
        $this->news->content   = $request->input('content');
        $this->news->isPrivate = $request->get('isPrivate');
        $this->news->date      = Carbon::now('Europe/London');
        $this->news->save();

    	if ($request->get('isPrivate') === 1) {
            MailGenerator::prestationMail($new, $request);
        }
    	return redirect('/actualites');
    }

    public function viewUpdate($id)
    {

        $news      = $this->news->getOneNews($id);

        return view('updateNews', ['news' => $news]);
    }

    public function update($id, Request $request) {

        $news      = $this->news->getOneNews($id);

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
