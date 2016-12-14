
@extends('layouts.app')

@section('content')

    <!--<h2>Update Walkpath: {{$walkpath->name}}</h2>-->

    <form action="/walkpath/{{$walkpath->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('name','text')->model($walkpath)->show() !!}

        {!! \Nvd\Crud\Form::input('description','text')->model($walkpath)->show() !!}

        {!! \Nvd\Crud\Form::input('status','text')->model($walkpath)->show() !!}
	
		<!-- onder crud: map -->
		<script type='text/javascript'>
			$(document).ready(function() {
				setFloor(0);
				setMode('drawRoutes');
			});
		</script>

		<main class="col-lg-12">
			<div id="map" class="map"></div>
		</main>

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection
