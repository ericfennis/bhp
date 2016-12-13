<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walkpath extends Model
{
    protected $fillable = [
        'name', 'description', 'status'
        ];


    public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function walkpathpoints()
    {
    	return $this->hasMany('App\WalkpathPoint','walkpath_id','id')->orderBy('point_order');
    }
}
