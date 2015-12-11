<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
	public function scopeActive($query)
	{
		return $query->where('active', '=', 1)->orderBy('modified_at', 'desc');
	}

    public function scopePdf($query, $ids)
    {
    	return $query->active()->whereIn('id', $ids);
    }
}
