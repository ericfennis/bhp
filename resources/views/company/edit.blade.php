@extends('layouts.app')

@section('content')

    <h2>Bedrijfsgegevens aanpassen: {{$company->walkpath_id}}</h2>

    <form action="/company/{{$company->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('walkpath_id','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('location_point','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('default_person','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('telephone','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('email','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('name','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('branch','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('description','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('logo','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('building','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('room_number','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('status','text')->model($company)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection