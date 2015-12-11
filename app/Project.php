<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Description;
use Illuminate\Database\Eloquent\SoftDeletes;


class Project extends Model
{
	use SoftDeletes;

	protected $morphClass = 'Project';

    public function descriptions() 
    {
    	return $this->morphMany('App\Description', 'association');
    }

    public function organization() 
    {
    	return $this->belongsTo('App\Organization');
    }

    public function scopeDisplay($query)
    {	
    	return $query->orderBy('rank', 'asc')->with('descriptions')->with('organization');
    }

    public function scopePdf($query, $ids)
    {
    	return $query->display()->whereIn('id', $ids);
    }
}
