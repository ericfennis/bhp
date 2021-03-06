@extends('layouts.app')

@section('content')

	<h2>Personen</h2>

	@include('person.create')

	<table class="table table-striped grid-view-tbl">

	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('Firstname','person.index','Voornaam')!!}
			{!!\Nvd\Crud\Html::sortableTh('Surname','person.index','Achternaam')!!}
			{!!\Nvd\Crud\Html::sortableTh('Company Id','person.index','Bedrijf')!!}
			{!!\Nvd\Crud\Html::sortableTh('Telephone','person.index','Telefoon')!!}
			{!!\Nvd\Crud\Html::sortableTh('Email','person.index','Email')!!}
			{!!\Nvd\Crud\Html::sortableTh('Website','person.index','Website')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','person.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','person.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="firstname" value="{{Request::input("firstname")}}"></td>
				<td><input type="text" class="form-control" name="surname" value="{{Request::input("surname")}}"></td>
				<td><input type="text" class="form-control" name="company_id" value="{{Request::input("company_id")}}"></td>
				<td><input type="text" class="form-control" name="telephone" value="{{Request::input("telephone")}}"></td>
				<td><input type="text" class="form-control" name="email" value="{{Request::input("email")}}"></td>
				<td><input type="text" class="form-control" name="website" value="{{Request::input("website")}}"></td>
				<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
				<td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
				<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
			</form>
		</tr>
	    </thead>

	    <tbody>
	    	@forelse ( $records as $record )
		    	<tr>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="firstname"
							  data-value="{{ $record->firstname }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/person/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->firstname }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="surname"
							  data-value="{{ $record->surname }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/person/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->surname }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="number"
							  data-name="company_id"
							  data-value="{{ $record->company_id }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/person/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->company_id }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="telephone"
							  data-value="{{ $record->telephone }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/person/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->telephone }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="email"
							  data-name="email"
							  data-value="{{ $record->email }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/person/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->email }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="website"
							  data-value="{{ $record->website }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/person/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->website }}</span>
						</td>
					<td>
						{{ $record->created_at }}
						</td>
					<td>
						{{ $record->updated_at }}
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'person', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 12])
	    	@endforelse
	    </tbody>

	</table>

	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

<script>
	$(".editable").editable({ajaxOptions:{method:'PUT'}});
</script>
@endsection
