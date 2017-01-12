@extends('layouts.app')

@section('content')

    <!--<h2>Update Facility: {{$facility->walkpath_points_id}}</h2>-->
	<div class="row">
		<button class="btn btn-default col-lg-1" onClick="javascript:history.back();">Vorige</button>
		<div class="col-lg-10" name="placeholder"></div>
		<button type="submit" class="btn btn-default col-lg-1" form="form">Opslaan!</button>
	</div>

    <form id="form" action="/facility/{{$facility->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        <!--{!! \Nvd\Crud\Form::input('walkpath_points_id','text')->model($facility)->show() !!}-->
		<div class="row form-group">
			<label class="col-lg-1" for="walkpath_points_id">Punt</label>
			<div class="col-lg-11">
				<input name="walkpath_points_id" id="walkpath_points_id" class="form-control wp-field" value="{{$facility->walkpath_points_id}}" type="text" readonly>
			</div>
		</div>

        {!! \Nvd\Crud\Form::input('name','text')->model($facility)->show() !!}

        {!! \Nvd\Crud\Form::input('icon','text')->model($facility)->show() !!}

        {!! \Nvd\Crud\Form::input('description','text')->model($facility)->show() !!}
		<!-- onder crud: map -->
		<script type='text/javascript'>
			$(document).ready(function() {
				setFloor(0);
				setMode('setPoint');
			});
		</script>

		<main class="col-lg-12">
			<div id="map" class="map"></div>
		</main>
    </form>

@endsection
