@extends('layouts.app')

@section('content')

    <h2>Bedrijfsgegevens aanpassen: {{$company->walkpath_id}}</h2>
	<div class="row">
		<button class="btn btn-default col-lg-1" onClick="javascript:history.back();">Vorige</button>
		<div class="col-lg-10" name="placeholder"></div>
		<button type="submit" class="btn btn-default col-lg-1" form="form">Opslaan!</button>
	</div>

    <form id="form" action="/company/{{$company->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        <!--{!! \Nvd\Crud\Form::input('walkpath_id','text')->model($company)->show() !!}-->
		<div class="row form-group">
			<label class="col-lg-1" for="status">route</label>
			<div class="col-lg-11">
				<select name="walkpath_id" id="walkpath_id" class="form-control" value="" type="text">
					@forelse ( $walkpaths as $walkpath )
						<option value="{{ $walkpath->id }}" {{ ($walkpath->id == $company->walkpath_id) ? 'selected' : '' }}>{{$walkpath->name}}</option>
					@empty
						<option value="0" disabled>Geen routes gevonden</option>
					@endforelse
				</select>
			</div>
		</div>


        <!--{!! \Nvd\Crud\Form::input('location_point','text')->model($company)->show() !!}-->
		<div class="row form-group">
			<label class="col-lg-1" for="location_point">Punt</label>
			<div class="col-lg-11">
				<input name="location_point" id="location_point" class="form-control wp-field" value="{{$company->location_point}}" type="text" readonly>
			</div>
		</div>

        <!--{!! \Nvd\Crud\Form::input('default_person','text')->model($company)->show() !!}-->
		<div class="row form-group">
			<label class="col-lg-1" for="status">Contactpersoon</label>
			<div class="col-lg-11">
				<select name="default_person" id="default_person" class="form-control" value="" type="text">
					@forelse ( $people as $person )
						<option value="{{ $person->id }}" {{ ($person->id == $company->default_person) ? 'selected' : '' }}>{{$person->surname}}, {{$person->firstname}}</option>
					@empty
						<option value="0" disabled>Geen personen gevonden</option>
					@endforelse
				</select>
			</div>
		</div>

        {!! \Nvd\Crud\Form::input('telephone','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('email','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('name','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('branch','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('description','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('logo','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('building','text')->model($company)->show() !!}

        {!! \Nvd\Crud\Form::input('room_number','text')->model($company)->show() !!}

        <div class="row form-group">
			<label class="col-lg-1" for="status">Status</label>
			<div class="col-lg-11">
				<select name="status" id="status" class="form-control" value="" type="text">
					<option value="0">Inactief</option>
					<option value="1" selected>Actief</option>
				</select>
			</div>
		</div>

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
