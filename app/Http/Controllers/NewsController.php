<?php

namespace App\Http\Controllers;

use App\Services\MailGenerator;
use Illuminate\Http\Request;
use App\News;
use Carbon\Carbon;
use Auth;

class NewsController extends Controller
{
    private $newsModel;

    public function __construct(News $news)
    {
        $this->newsModel = $news;
    }

    public function index() {
    	if (Auth::check()) {
    	    $news = $this->newsModel->getAllNews();
        } else {
            $news = $this->newsModel->getAllNewsPublic();;
        }

    	return view('FO.actualites', ['news' => $news, 'imageUrl' => 'img/actu.jpg']);
    }

    public function create() {
    	return view('BO.News.createNews');
    }

    public function store(Request $request)
    {
    	$this->newsModel->title     = $request->input('title');
        $this->newsModel->content   = $request->input('content');
        $this->newsModel->isPrivate = $request->get('isPrivate');
        $this->newsModel->date      = Carbon::now('Europe/Paris');
        $this->newsModel->save();

    	//if ($request->get('isPrivate') === '1') {
            MailGenerator::prestationMail($this->newsModel, $request);
        //}
    	return redirect('/admin/adminNews');
    }

    public function viewUpdate($id)
    {
        $news      = $this->newsModel->getOneNews($id);

        return view('BO.News.updateNews', ['news' => $news]);
    }

    public function update($id, Request $request)
    {
        $news      = $this->newsModel->getOneNews($id);
        if ($request->input('title')) {
            $news->title = $request->input('title');
        }

        if ($request->input('content')) {
            $news->content = $request->input('content');
        }
        if (null !== $request->get('isPrivate')) {
            $news->isPrivate = $request->get('isPrivate');
        }
        $news->date = Carbon::now('Europe/Paris');
        $news->save();
        return redirect('/admin/adminNews');
    }


    public function delete($id)
    {
        $new = $this->newsModel->find($id);
        $new->delete();

        return redirect('admin/adminNews');
    }
}
