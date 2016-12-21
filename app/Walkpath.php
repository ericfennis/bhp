<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Walkpath extends Model {

    public $guarded = ["id","created_at","updated_at"];
	protected $fillable = ['name', 'description', 'status'];

    public static function findRequested()
    {
        $query = Walkpath::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('name') and $query->where('name','like','%'.\Request::input('name').'%');
        \Request::input('description') and $query->where('description','like','%'.\Request::input('description').'%');
        \Request::input('status') and $query->where('status',\Request::input('status'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|integer',
        ];

        // no list is provided
        if(!$attributes)
            return $rules;

        // a single attribute is provided
        if(!is_array($attributes))
            return [ $attributes => $rules[$attributes] ];

        // a list of attributes is provided
        $newRules = [];
        foreach ( $attributes as $attr )
            $newRules[$attr] = $rules[$attr];
        return $newRules;
    }

    public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function WalkpathPoint()
    {
    	return $this->hasMany('App\WalkpathPoint','walkpath_id','id')->orderBy('point_order');
    }

	public function Point()
	{
		$books = WalkpathPoint::with('point')->get();

		foreach ($books as $book) {
			echo $book->WalkpathPoint->point;
		}
	}
}
