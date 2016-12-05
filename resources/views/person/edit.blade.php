@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Update Person: {{$person->firstname}}</h2>

    <form action="/person/{{$person->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('firstname','text')->model($person)->show() !!}

        {!! \Nvd\Crud\Form::input('surname','text')->model($person)->show() !!}

        {!! \Nvd\Crud\Form::input('profilepicture','text')->model($person)->show() !!}

        {!! \Nvd\Crud\Form::input('telephone','text')->model($person)->show() !!}

        {!! \Nvd\Crud\Form::input('email','text')->model($person)->show() !!}

        {!! \Nvd\Crud\Form::input('website','text')->model($person)->show() !!}

        {!! \Nvd\Crud\Form::input('status','text')->model($person)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection