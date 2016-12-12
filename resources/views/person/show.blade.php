@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Person: {{$person->firstname}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$person->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Firstname</h4>
            <h5>{{$person->firstname}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Surname</h4>
            <h5>{{$person->surname}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Profilepicture</h4>
            <h5>{{$person->profilepicture}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Telephone</h4>
            <h5>{{$person->telephone}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Email</h4>
            <h5>{{$person->email}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Website</h4>
            <h5>{{$person->website}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Status</h4>
            <h5>{{$person->status}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$person->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$person->updated_at}}</h5>
        </li>
        
    </ul>

@endsection