<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    public $timestamps = false;

    public function getAllNews() {
    	$news = News::all()->sortByDesc("date");
    	return $news;
    }

    public function getOneNews($id) {
        $news = News::find($id);
        return $news;
    }
}
