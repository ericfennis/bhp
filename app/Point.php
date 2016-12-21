<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'route_id', 'point_id'
        ];

    public function WalkpathPoint()
    {
    	return $this->belongsToMany('App\WalkpathPoint');
    }
}
