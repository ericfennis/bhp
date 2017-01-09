@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Update Facility: {{$facility->walkpath_points_id}}</h2>

    <form action="/facility/{{$facility->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('walkpath_points_id','text')->model($facility)->show() !!}

        {!! \Nvd\Crud\Form::input('name','text')->model($facility)->show() !!}

        {!! \Nvd\Crud\Form::input('icon','text')->model($facility)->show() !!}

        {!! \Nvd\Crud\Form::input('description','text')->model($facility)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection