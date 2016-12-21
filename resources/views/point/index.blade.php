@extends('layouts.app')

@section('content')
<h2>Punten beheren</h2>

	<script type='text/javascript'>
		$(document).ready(function() {
			setFloor(0);
			setMode('drawIcons');
		});
	</script>
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<main>
					<div id="map" class="map"></div>
				</main>
			</div>
		</div>
	</div>
@endsection

