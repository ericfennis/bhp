@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Company: {{$company->route_id}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$company->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Route Id</h4>
            <h5>{{$company->route_id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Location Point</h4>
            <h5>{{$company->location_point}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Default Person</h4>
            <h5>{{$company->default_person}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Name</h4>
            <h5>{{$company->name}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Description</h4>
            <h5>{{$company->description}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Logo</h4>
            <h5>{{$company->logo}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Building</h4>
            <h5>{{$company->building}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Room Number</h4>
            <h5>{{$company->room_number}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Status</h4>
            <h5>{{$company->status}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$company->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$company->updated_at}}</h5>
        </li>
        
    </ul>

@endsection