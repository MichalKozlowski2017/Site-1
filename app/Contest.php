<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    public function getDateStartAttribute($value) {
    	return date('d-m-Y', strtotime($value));
    }
    public function getDateEndAttribute($value) {
    	return date('d-m-Y', strtotime($value));
    }
}
