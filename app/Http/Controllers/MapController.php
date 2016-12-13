<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Map;

class MapController extends Controller
{
    public function index() {

		$maps = Map::all();
		return view('map.index', compact('maps'));
	}
}
