@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Update Walkpath: {{$walkpath->name}}</h2>

    <form action="/walkpath/{{$walkpath->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('name','text')->model($walkpath)->show() !!}

        {!! \Nvd\Crud\Form::input('description','text')->model($walkpath)->show() !!}

        {!! \Nvd\Crud\Form::input('status','text')->model($walkpath)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection