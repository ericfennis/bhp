@extends('layouts.app')

@section('content')

    <h2>Update Person: {{$person->firstname}}</h2>

    <form action="/person/{{$person->id}}" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('firstname','text')->model($person)->show() !!}

        {!! \Nvd\Crud\Form::input('surname','text')->model($person)->show() !!}

		<div class="row form-group">
			<label class="col-lg-1" for="status">Bedrijf</label>
			<div class="col-lg-11">
				<select name="company_id" id="company_id" class="form-control" value="" type="text">
					@forelse ( $companies as $company )
						<option value="{{ $company->id }}" {{ ($company->id == $person->company_id) ? 'selected' : '' }}>{{$company->name}}</option>
					@empty
						<option value="0" disabled>Geen bedrijven gevonden</option>
					@endforelse
				</select>
			</div>
		</div>

        {!! \Nvd\Crud\Form::input('profilepicture','file')->model($person)->show() !!}

        {!! \Nvd\Crud\Form::input('telephone','text')->model($person)->show() !!}

        {!! \Nvd\Crud\Form::input('email','text')->model($person)->show() !!}

        {!! \Nvd\Crud\Form::input('website','text')->model($person)->show() !!}

        <div class="row form-group">
			<label class="col-lg-1" for="status">Status</label>
			<div class="col-lg-11">
				<select name="status" id="status" class="form-control" value="" type="text">
					<option value="0">Inactief</option>
					<option value="1" selected>Actief</option>
				</select>
			</div>
		</div>

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection
