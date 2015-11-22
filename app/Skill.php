<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
	use SoftDeletes;
    public static function display()
    {
    	return self::orderBy('name', 'asc')->get();
    }
}
