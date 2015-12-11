<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Job;

class Description extends Model
{
	use SoftDeletes;

	protected $morphClass = 'Description';

    public function association()
    {
    	return $this->morphTo();
    }
}
