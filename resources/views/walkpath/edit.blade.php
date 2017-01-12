
@extends('layouts.app')

@section('content')

    <!--<h2>Update Walkpath: {{$walkpath->name}}</h2>-->
	<div class="row">
		<button class="btn btn-default col-lg-1" onClick="javascript:history.back();">Vorige</button>
		<div class="col-lg-10" name="placeholder"></div>
		<button type="submit" class="btn btn-default col-lg-1" form="form">Opslaan!</button>
	</div>

    <form id="form" action="/walkpath/{{$walkpath->id}}" class="row" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('name','text')->model($walkpath)->show() !!}

        {!! \Nvd\Crud\Form::input('description','text')->model($walkpath)->show() !!}

<!--        {!! \Nvd\Crud\Form::input('status','text')->model($walkpath)->show() !!} -->
		<div class="row form-group">
			<label class="col-lg-1" for="status">Status</label>
			<div class="col-lg-11">
				<select name="status" id="status" class="form-control" value="" type="text">
					<option value="0">Inactief</option>
					<option value="1" selected>Actief</option>
				</select>
			</div>
		</div>

		{!! \Nvd\Crud\Form::input('json','text')->show() !!}


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



    </form>

@endsection
