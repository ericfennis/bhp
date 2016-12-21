<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Company;

use App\Person;

class ListController extends Controller
{
    public function index()
    {
    	$companies = Company::all();
	  	return view('list.index', compact('companies'));
    }


    public function getJSON()
    {
    	$Companies = Company::orderBy('name')->get();
    	$People = Person::orderBy('firstname')->get();
    	$Education = array();

    	if(!empty($People)) {
    		
    		for ($i=0; $i < count($People) ; $i++) { 
    			// Give objectPerson fullname
    			$People[$i]->name = $People[$i]->firstname.' '.$People[$i]->surname;

 				// Give objectPerson the name of the company he/she works
 				if(!empty($People[$i]->company_id)) {

 					//search Companies with company_id of person
 					foreach ($Companies as $Company) {

 						if($Company->id == $People[$i]->company_id) {


 							$People[$i]->company = $Company->name;
                            $People[$i]->building = $Company->building;
                            $People[$i]->room_number = number_format($Company->room_number,2);

 							break;
 						}
 					}
 					
 				}
    		}

    	}
    	if(!empty($Companies)) {
			// Filter companies with branch onderwijsinstelling and add them to $education
    		foreach ($Companies as $Company) {
    			if ($Company->branch == 'onderwijsinstelling' || $Company->branch == 'Onderwijsinstelling') {
    				array_push($Education, $Company);
    			}
    		}
    		
    	}

    	return array(
    			'people' => $People,
    			'companies' => $Companies,
    			'education' => $Education
    			);

    }
}
