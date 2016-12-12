<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalkpathPoint extends Model
{
    protected $fillable = [
        'map_id'
        ];

    public function walkpath()
    {
    	return $this->belongsTo('App\Walkpath');
    }
     public function point()
    {
        return $this->hasOne('App\Point','point_id','id');
    }
}
