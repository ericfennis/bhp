@extends('layouts.app')

@section('content')

	<h2>Bedrijven</h2>

	@include('company.create')

	<table class="table table-striped grid-view-tbl">

	    <thead>
		<tr class="header-row">

			{!!\Nvd\Crud\Html::sortableTh('Name','company.index','Naam')!!}
			{!!\Nvd\Crud\Html::sortableTh('Branch','company.index','Bedrijfstak')!!}
			{!!\Nvd\Crud\Html::sortableTh('Email','company.index','Email')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','company.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','company.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
				<td><input type="text" class="form-control" name="branch" value="{{Request::input("branch")}}"></td>
				<td><input type="text" class="form-control" name="email" value="{{Request::input("email")}}"></td>
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
							  data-name="name"
							  data-value="{{ $record->name }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->name }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="branch"
							  data-value="{{ $record->branch }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->branch }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="email"
							  data-name="email"
							  data-value="{{ $record->email }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->email }}</span>
						</td>
					<td>
						{{ $record->created_at }}
						</td>
					<td>
						{{ $record->updated_at }}
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'company', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 16])
	    	@endforelse
	    </tbody>

	</table>

	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

<script>
	$(".editable").editable({ajaxOptions:{method:'PUT'}});
</script>
@endsection
