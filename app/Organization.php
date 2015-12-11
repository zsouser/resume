<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function job()
    {
    	return $this->hasOne('App\Job');
    }

    public function credential()
    {
    	return $this->hasOne('App\Credential');
    }
}
