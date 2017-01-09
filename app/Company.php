<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Company::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('walkpath_id') and $query->where('walkpath_id',\Request::input('walkpath_id'));
        \Request::input('location_point') and $query->where('location_point',\Request::input('location_point'));
        \Request::input('default_person') and $query->where('default_person',\Request::input('default_person'));
        \Request::input('telephone') and $query->where('telephone','like','%'.\Request::input('telephone').'%');
        \Request::input('email') and $query->where('email','like','%'.\Request::input('email').'%');
        \Request::input('name') and $query->where('name','like','%'.\Request::input('name').'%');
        \Request::input('branch') and $query->where('branch','like','%'.\Request::input('branch').'%');
        \Request::input('description') and $query->where('description','like','%'.\Request::input('description').'%');
        \Request::input('logo') and $query->where('logo','like','%'.\Request::input('logo').'%');
        \Request::input('building') and $query->where('building',\Request::input('building'));
        \Request::input('room_number') and $query->where('room_number',\Request::input('room_number'));
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
            'walkpath_id' => 'required|integer',
            'location_point' => 'required|integer',
            'default_person' => 'required|integer',
            'telephone' => 'required|string|max:255',
            'email' => 'required|string|max:64|email',
            'name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'logo' => 'required|string|max:255',
            'building' => 'required',
            'room_number' => 'required',
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
    
    public function walkpath()
    {
        return $this->hasOne('App\Walkpath','id','walkpath_id');
    }

}
