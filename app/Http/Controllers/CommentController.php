<?php

namespace App\Http\Controllers;

use App\Comment;
use App\EventModel;
use App\Services\MailGenerator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    private $comments;

    public function __construct(Comment $comments)
    {
        $this->comments = $comments;
    }

    public function store($id, Request $request)
    {
        $this->comments->content  = $request->input('content');
        $this->comments->user_id  = Auth::user()->id;
        $this->comments->event_id = $id;
        $this->comments->date     = Carbon::now('Europe/Paris');
        $this->comments->save();
          MailGenerator::prestationMail(EventModel::find($id), $request);
        return redirect('/agenda/' . $id);
    }
}
