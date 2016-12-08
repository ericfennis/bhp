<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Company;
use App\Walkpath;
use App\WalkpathPoint;
use App\Point;


class WalkpathController extends Controller
{
    public function getWalkpath($id)
    {
        $company = Company::findOrFail($id);
        $walkpathpoints = $company->walkpath->walkpathpoints;
        $points = array();
        foreach ($walkpathpoints as $walkpath) {
            $point = Point::find($walkpath->id);
            $coords = array($point->map_id ,$point->x,$point->y);
            //array_pop(, 'asdadasdas');$coords
            $points = array_merge($points,array($coords));
        }
        
        //return $points;
        //var_dump();

    	// $returnArray = array(
    	// 	array(100,200),
    	// 	array(100,200),
    	// 	array(120,180),
    	// 	array(160,140),
    	// 	array(190,120),
    	// 	array(200,190),
    	// 	array(110,140),
    	// 	array($id),
    	// );
    

    	return $points;
    }
}
