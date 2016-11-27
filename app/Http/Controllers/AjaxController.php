<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function method(Request $request)
    {
    	return response()->json(['return' => 'some data']);
    }
}
