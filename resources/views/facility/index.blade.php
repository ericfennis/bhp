@extends('layouts.app')

@section('content')

	<h2>Faciliteiten</h2>

	@include('facility.create')

	<table class="table table-striped grid-view-tbl">

	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','facility.index','Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('walkpath_points_id','facility.index','Walkpath Points Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('name','facility.index','Name')!!}
			{!!\Nvd\Crud\Html::sortableTh('icon','facility.index','Icon')!!}
			{!!\Nvd\Crud\Html::sortableTh('description','facility.index','Description')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','facility.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','facility.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="walkpath_points_id" value="{{Request::input("walkpath_points_id")}}"></td>
				<td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
				<td><input type="text" class="form-control" name="icon" value="{{Request::input("icon")}}"></td>
				<td><input type="text" class="form-control" name="description" value="{{Request::input("description")}}"></td>
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
						{{ $record->id }}
						</td>
					<td>
						<span class="editable"
							  data-type="number"
							  data-name="walkpath_points_id"
							  data-value="{{ $record->walkpath_points_id }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/facility/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->walkpath_points_id }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="name"
							  data-value="{{ $record->name }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/facility/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->name }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="icon"
							  data-value="{{ $record->icon }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/facility/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->icon }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="description"
							  data-value="{{ $record->description }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/facility/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->description }}</span>
						</td>
					<td>
						{{ $record->created_at }}
						</td>
					<td>
						{{ $record->updated_at }}
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'facility', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 8])
	    	@endforelse
	    </tbody>

	</table>

	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

<script>
	$(".editable").editable({ajaxOptions:{method:'PUT'}});
</script>
@endsection
