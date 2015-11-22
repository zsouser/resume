<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Description extends Model
{
	use SoftDeletes;
    public function job()
    {
    	return $this->belongsTo('App\Job');
    }

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }
}
