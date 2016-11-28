<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Company;

class ListController extends Controller
{
    public function index()
    {
    	$companies = Company::all();

	  	return view('list.index', compact('companies'));
    }
}
