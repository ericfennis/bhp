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
        $points = array(
                0 => array(),
                1 => array(),
                2 => array(),
                3 => array()
            );
        // looping walkpathpoints
        foreach ($walkpathpoints as $walkpath) {
            // find each point with id.
            $point = Point::find($walkpath->id);
            //make-up the array for JSON structure
            $coords = array($point->x,$point->y);

            $points[$point->map_id] = array_merge($points[$point->map_id],array($coords));
            //Merge the coords with the points array
            //$points = array_merge($points,array($coords));

        }
        // return Points
    	return $points;
    }
}
