<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Description;
use Illuminate\Database\Eloquent\SoftDeletes;


class Project extends Model
{
	use SoftDeletes;
    public function descriptions() 
    {
    	return $this->hasMany('App\Description');
    }
}
