@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Walkpath: {{$walkpath->name}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$walkpath->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Name</h4>
            <h5>{{$walkpath->name}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Description</h4>
            <h5>{{$walkpath->description}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Status</h4>
            <h5>{{$walkpath->status}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$walkpath->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$walkpath->updated_at}}</h5>
        </li>
        
    </ul>

@endsection