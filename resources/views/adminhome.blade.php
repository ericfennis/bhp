@extends('layouts.app')

@section('content')
<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
	$(document).ready(function (){
		$('#navButtons').hide();
	});
</script>

<div class="container">
	<div class="row">
		<div>
			<div class="col-md-2">
				<center>
					<a href="/walkpath">
						<i class="fa fa-location-arrow fa-5x" aria-hidden="true"></i><br />
						Routes
					</a>
				</center>
			</div>

			<div class="col-md-2">
				<center>
					<a href="/point">
						<i class="fa fa-thumb-tack fa-5x" aria-hidden="true"></i><br />
						Punten
					</a>
				</center>
			</div>

			<div class="col-md-2">
				<center>
					<a href="/facility">
						<i class="fa fa-map-o fa-5x" aria-hidden="true"></i><br />
						Faciliteiten
					</div>
				</center>
			</div>


			<div class="col-md-2">
				<center>
					<a href="/company">
						<i class="fa fa-building-o fa-5x" aria-hidden="true"></i><br />
						Bedrijven
					</a>
				</center>
			</div>


			<div class="col-md-2">
				<center>
					<a href="/person">
						<i class="fa fa-users fa-5x" aria-hidden="true"></i><br />
						Personen
					</a>
				</center>
			</div>

			<div class="col-md-2">
				<center>
					<a href="/logout">
						<i class="fa fa-sign-out fa-5x" aria-hidden="true"></i><br />
						Uitloggen
					</a>
				</center>
			</div>
		</div>
</div>
@endsection
