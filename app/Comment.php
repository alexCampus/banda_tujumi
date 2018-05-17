<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments_banda';

    public $timestamps = false;

    public function getCommentsByEvents($id)
    {
        $comments = Comment::where('event_id', '=', $id)->orderBy('date', 'desc')->get();
        return $comments;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
