<?php
namespace App\Http\Controllers;

use App\Person;
use App\Company;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    public $viewDir = "person";

    public function index()
    {
        $records = Person::findRequested();
		$companies = Company::all();
        return $this->view("index", array('records' => $records,  'companies' => $companies));
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
        $this->validate($request, Person::validationRules());

		//geen profielfoto = invullen
		if($request->profilepicture == ''){
			$request->merge(array('Profilepicture' => "geen"));
		}

        $person = Person::create($request->all());

		//alles goed én een plaatje? verwerk plaatje en updaten (met id van persoon)
		if($request->profilepicture != ''){
			$imageName = $person->id . '.' .
				$request->file('profilepicture')->getClientOriginalExtension();

			$request->file('profilepicture')->move(
				base_path() . '/public/images/person/', $imageName
			);
			$request->merge(array('Profilepicture' => "/images/person/" . $imageName));

			$person->update($request->all());
		}



        return redirect('/person');
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Person $person)
    {
        return $this->view("show",['person' => $person]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Person $person)
    {
		$companies = Company::all();
        return $this->view( "edit", array('person' => $person, 'companies' => $companies));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {


        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Person::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);

            $person->update($data);
            return "Record updated";
        }

        $this->validate($request, Person::validationRules());

		//alles goed én een plaatje? verwerk plaatje
		if($request->profilepicture != ''){
			$imageName = $person->id . '.' .
				$request->file('profilepicture')->getClientOriginalExtension();

			$request->file('profilepicture')->move(
				base_path() . '/public/images/person/', $imageName
			);
			$request->merge(array('Profilepicture' => "/images/person/" . $imageName));
		}

        $person->update($request->all());


        return redirect('/person');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Person $person)
    {
        $person->delete();
        return redirect('/person');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
