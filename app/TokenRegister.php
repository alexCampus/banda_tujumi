<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenRegister extends Model
{
    public $timestamps = false;

    public function getId() {
		return $this->id;
	}
}
