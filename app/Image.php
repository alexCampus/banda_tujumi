<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

    public $timestamps = false;

     public function getAllImages() {
    	$images = Image::all();
    	return $images;
    }
}
