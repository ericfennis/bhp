@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Facility: {{$facility->walkpath_points_id}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$facility->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Walkpath Points Id</h4>
            <h5>{{$facility->walkpath_points_id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Name</h4>
            <h5>{{$facility->name}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Icon</h4>
            <h5>{{$facility->icon}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Description</h4>
            <h5>{{$facility->description}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$facility->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$facility->updated_at}}</h5>
        </li>
        
    </ul>

@endsection