<?php
namespace App\Http\Controllers;

use App\Company;
use App\Person;
use App\Walkpath;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public $viewDir = "company";

    public function index()
    {
        $records = Company::findRequested();
		$people = Person::all();
		$walkpaths = Walkpath::all();
        return $this->view( "index", array('records' => $records, 'people' => $people, 'walkpaths' => $walkpaths ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $this->validate($request, Company::validationRules());
        if(empty($request->default_person)) {
            $request->merge(array('default_person' => 0));
        }
        if(empty($request->location_point)) {
            $request->merge(array('location_point' => 0));
        }
		if(empty($request->logo)) {
            $request->merge(array('logo' => 'geen'));
        }


        $company = Company::create($request->all());

		//alles goed én een plaatje? verwerk plaatje
		if($request->logo != ''){
			$imageName = $company->id . '.' .
				$request->file('logo')->getClientOriginalExtension();

			$request->file('logo')->move(
				base_path() . '/public/images/company/', $imageName
			);
			$request->merge(array('Logo' => "/images/company/" . $imageName));
			$company->update($request->all());
		}


        return redirect('/company');
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Company $company)
    {
        return $this->view("show",['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Company $company)
    {
		$people = Person::all();
		$walkpaths = Walkpath::all();
        return $this->view( "edit", array('company' => $company, 'people' => $people, 'walkpaths' => $walkpaths));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Company::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $company->update($data);
            return "Record updated";
        }

        $this->validate($request, Company::validationRules());

		//alles goed én een plaatje? verwerk plaatje
		if($request->logo != ''){
			$imageName = $company->id . '.' .
				$request->file('logo')->getClientOriginalExtension();

			$request->file('logo')->move(
				base_path() . '/public/images/company/', $imageName
			);
			$request->merge(array('Logo' => "/images/company/" . $imageName));
		}
        $company->update($request->all());

        return redirect('/company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Company $company)
    {
        $company->delete();
        return redirect('/company');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
