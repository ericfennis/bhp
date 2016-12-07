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
            array_push($points, Point::find($walkpath->id));
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
