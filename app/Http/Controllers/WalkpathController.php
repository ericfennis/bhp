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
        // load all walkpath for company
        $company = Company::findOrFail($id);
        // load all Walkpath points for the walkpath
        $walkpathpoints = $company->walkpath->walkpathpoints;
        // create array
        $points = array();
        // looping walkpathpoints
        foreach ($walkpathpoints as $walkpath) {
            // find each point with id.
            $point = Point::find($walkpath->id);
            //make-up the array for JSON structure
            $coords = array($point->map_id ,$point->x,$point->y);
            //Merge the coords with the points array
            $points = array_merge($points,array($coords));
        }
        // return Points
    	return $points;
    }
}
