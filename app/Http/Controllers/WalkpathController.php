<?php
namespace App\Http\Controllers;

use App\Company;
use App\Walkpath;
use App\WalkpathPoint;
use App\Point;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WalkpathController extends Controller
{
    public $viewDir = "walkpath";

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

    public function index()
    {
        $records = Walkpath::findRequested();
        return $this->view( "index", ['records' => $records] );
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
        $this->validate($request, Walkpath::validationRules());

        Walkpath::create($request->all());

        return redirect('/walkpath');
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Walkpath $walkpath)
    {
        return $this->view("show",['walkpath' => $walkpath]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Walkpath $walkpath)
    {
        return $this->view( "edit", ['walkpath' => $walkpath] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Walkpath $walkpath)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Walkpath::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $walkpath->update($data);
            return "Record updated";
        }

        $this->validate($request, Walkpath::validationRules());

        $walkpath->update($request->all());

        return redirect('/walkpath');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Walkpath $walkpath)
    {
        $walkpath->delete();
        return redirect('/walkpath');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
