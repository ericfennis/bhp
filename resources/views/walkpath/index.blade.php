@extends('vendor.crud.single-page-templates.common.app')

@section('content')

	<h2>Walkpaths</h2>

	@include('walkpath.create')

	<table class="table table-striped grid-view-tbl">
	    
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','walkpath.index','Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('name','walkpath.index','Name')!!}
			{!!\Nvd\Crud\Html::sortableTh('description','walkpath.index','Description')!!}
			{!!\Nvd\Crud\Html::sortableTh('status','walkpath.index','Status')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','walkpath.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','walkpath.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
				<td><input type="text" class="form-control" name="description" value="{{Request::input("description")}}"></td>
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
							  data-type="text"
							  data-name="name"
							  data-value="{{ $record->name }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/walkpath/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->name }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="description"
							  data-value="{{ $record->description }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/walkpath/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->description }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="number"
							  data-name="status"
							  data-value="{{ $record->status }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/walkpath/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->status }}</span>
						</td>
					<td>
						{{ $record->created_at }}
						</td>
					<td>
						{{ $record->updated_at }}
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'walkpath', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 7])
	    	@endforelse
	    </tbody>

	</table>

	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

<script>
	$(".editable").editable({ajaxOptions:{method:'PUT'}});
</script>
@endsection