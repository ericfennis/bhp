@extends('layouts.app')

@section('content')

	<h2>Bedrijven</h2>

	@include('company.create')

	<table class="table table-striped grid-view-tbl">
	    
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','company.index','Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('walkpath_id','company.index','Walkpath Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('location_point','company.index','Location Point')!!}
			{!!\Nvd\Crud\Html::sortableTh('default_person','company.index','Default Person')!!}
			{!!\Nvd\Crud\Html::sortableTh('telephone','company.index','Telephone')!!}
			{!!\Nvd\Crud\Html::sortableTh('email','company.index','Email')!!}
			{!!\Nvd\Crud\Html::sortableTh('name','company.index','Name')!!}
			{!!\Nvd\Crud\Html::sortableTh('branch','company.index','Branch')!!}
			{!!\Nvd\Crud\Html::sortableTh('description','company.index','Description')!!}
			{!!\Nvd\Crud\Html::sortableTh('logo','company.index','Logo')!!}
			{!!\Nvd\Crud\Html::sortableTh('building','company.index','Building')!!}
			{!!\Nvd\Crud\Html::sortableTh('room_number','company.index','Room Number')!!}
			{!!\Nvd\Crud\Html::sortableTh('status','company.index','Status')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','company.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','company.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="walkpath_id" value="{{Request::input("walkpath_id")}}"></td>
				<td><input type="text" class="form-control" name="location_point" value="{{Request::input("location_point")}}"></td>
				<td><input type="text" class="form-control" name="default_person" value="{{Request::input("default_person")}}"></td>
				<td><input type="text" class="form-control" name="telephone" value="{{Request::input("telephone")}}"></td>
				<td><input type="text" class="form-control" name="email" value="{{Request::input("email")}}"></td>
				<td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
				<td><input type="text" class="form-control" name="branch" value="{{Request::input("branch")}}"></td>
				<td><input type="text" class="form-control" name="description" value="{{Request::input("description")}}"></td>
				<td><input type="text" class="form-control" name="logo" value="{{Request::input("logo")}}"></td>
				<td><input type="text" class="form-control" name="building" value="{{Request::input("building")}}"></td>
				<td><input type="text" class="form-control" name="room_number" value="{{Request::input("room_number")}}"></td>
				<td><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"></td>
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
							  data-name="walkpath_id"
							  data-value="{{ $record->walkpath_id }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->walkpath_id }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="number"
							  data-name="location_point"
							  data-value="{{ $record->location_point }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->location_point }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="number"
							  data-name="default_person"
							  data-value="{{ $record->default_person }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->default_person }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="telephone"
							  data-value="{{ $record->telephone }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->telephone }}</span>
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
							  data-type="text"
							  data-name="description"
							  data-value="{{ $record->description }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->description }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="logo"
							  data-value="{{ $record->logo }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->logo }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="building"
							  data-value="{{ $record->building }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->building }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="room_number"
							  data-value="{{ $record->room_number }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->room_number }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="number"
							  data-name="status"
							  data-value="{{ $record->status }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/company/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->status }}</span>
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