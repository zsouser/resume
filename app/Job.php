<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
	use SoftDeletes;

	protected $morphClass = 'Job';

    public function descriptions() 
    {
    	return $this->morphMany('App\Description', 'association');
    }

    public function projects()
    {
    	return $this->morphMany('App\Project', 'association');
    }

    public function organization()
    {
    	return $this->belongsTo('App\Organization');
    }

    public function scopeDisplay($query) 
    {
    	return $query->orderBy('rank', 'asc')->with('descriptions')->with('organization')->with('projects');
    }

    public function scopePdf($query, $ids)
    {
    	return $query->display()->whereIn('id', $ids);
    }
}
