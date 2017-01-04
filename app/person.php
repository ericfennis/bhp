<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Person::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('firstname') and $query->where('firstname','like','%'.\Request::input('firstname').'%');
        \Request::input('surname') and $query->where('surname','like','%'.\Request::input('surname').'%');
        \Request::input('profilepicture') and $query->where('profilepicture','like','%'.\Request::input('profilepicture').'%');
        \Request::input('company_id') and $query->where('company_id',\Request::input('company_id'));
        \Request::input('telephone') and $query->where('telephone','like','%'.\Request::input('telephone').'%');
        \Request::input('email') and $query->where('email','like','%'.\Request::input('email').'%');
        \Request::input('website') and $query->where('website','like','%'.\Request::input('website').'%');
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
            'firstname' => 'required|string|max:64',
            'surname' => 'required|string|max:64',
            'profilepicture' => 'required|string|max:255',
            'company_id' => 'required|integer',
            'telephone' => 'required|string|max:255',
            'email' => 'required|string|max:64|email',
            'website' => 'required|string|max:255',
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

}
