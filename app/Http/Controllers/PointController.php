<?php
namespace App\Http\Controllers;

use DB;
use App\Company;
use App\Walkpath;
use App\WalkpathPoint;
use App\Point;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PointController extends Controller
{
    public $viewDir = "point";
	
	//hieronder de interfacedingen
	public function index()
	{
		$points = Point::all();
		return view('point.index', compact('points'));
	}

	//hieronder de ajax dingen ;)
    public function getAll()
    {
        $points = Point::all();
        return json_encode($points);
    }

    public function addPoint($map, $x, $y)
    {
		$id = DB::table('points')->insertGetId(
			array('map_id' => $map, 'x' => $x, 'y' => $y)
		);
        return $id;
    }

    public function delPoint($id)
    {
		$point = Point::findOrFail($id);
        $point->delete();
		return 'success';
    }

}
