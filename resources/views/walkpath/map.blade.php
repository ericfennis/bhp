@extends('layouts.page')

@section('content')
	<script type='text/javascript'>
		$(document).ready(function() {
			setFloor(0);
			setMode('drawIcons');
		});
	</script>

	<main>
		<div id="map" class="map"></div>
	</main>
@endsection

