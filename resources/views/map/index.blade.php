@extends('layouts.page')

@section('content')
	<script type='text/javascript'>
		$(document).ready(function() {
			setFloor(0);
			
			//teken de toiletten
			addIcon(0, 'img/icons/WC (Fill).png', 'toilet', 0, 182.8882180970813, 269.8107913554641);
			addIcon(0, 'img/icons/WC (Fill).png', 'toilet', 0, 359.6649133937186, 454.37322191372243);

			//teken alles op de begane grond
			addIcon(0, 'img/icons/Beginpunt (Fill).png', 'route-begin', 0, 87.25517739600188, 515.7997405507241);
			addRoute(0, 87.25517739600188, 515.7997405507241, 181.77255084989517, 520.089303008371);
			addRoute(0, 181.77255084989517, 520.089303008371, 191.12767140564603, 425.24956209240486);
			addRoute(0, 191.12767140564603, 425.24956209240486, 211.60076314383846, 331.1205132058271);
			addIcon(0, 'img/icons/Trap (Line).png', 'switch-floor', 1, 211.60076314383846, 331.1205132058271);//trap omhoog naar v1

			//teken alles op de eerste verdieping
			addIcon(1, 'img/icons/Trap (Line).png', 'switch-floor', 0, 211.60076314383846, 331.1205132058271);//trap omlaag naar bg
			addRoute(1, 211.60076314383846, 331.1205132058271, 217.8126787429306, 260.46886477583973);
			addRoute(1, 217.8126787429306, 260.46886477583973, 425.8198910658566, 276.94793979000525);
			addRoute(1, 425.8198910658566, 276.94793979000525, 415.9707357590965, 369.28755355025527);
			addRoute(1, 415.9707357590965, 369.28755355025527, 436.9001907859601, 371.7499432498958);
			addRoute(1, 436.9001907859601, 371.7499432498958, 426.32169461714, 464.5669774843762);
			addIcon(1, 'img/icons/Eindbestemming (Fill).png', 'route-end', 0, 426.32169461714, 464.5669774843762);

			//herkenninspunt op verdieping 1
			addIcon(1, 'img/icons/WC (Fill).png', 'popup-sightseeing', 0, 425.8198910658566, 276.94793979000525);

		});
	</script>

	<main>
		<div id="map" class="map"></div>
	</main>
@endsection

