<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
	use SoftDeletes;

    public function scopeDisplay($query) 
    {
    	return $query->orderBy('name', 'asc');
    }

    public function scopePdf($query, $ids)
    {
    	return $query->whereIn('id', $ids)->orderBy('name', 'asc');
    }
}
