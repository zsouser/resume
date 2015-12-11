<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credential extends Model
{
	protected $morphClass = 'Credential';

    public function projects() 
    {
    	return $this->morphMany('App\Project', 'association');
    }

    public function images() 
    {
    	return $this->morphMany('App\Image', 'association');
    }

    public function organization()
    {
    	return $this->belongsTo('App\Organization');
    }

    public function scopeDisplay($query) 
    {
    	return $query->orderBy('rank', 'asc')->with('organization')->with('projects');
    }

    public function scopePdf($query, $ids)
    {
    	return $query->display()->whereIn('id', $ids);
    }
}