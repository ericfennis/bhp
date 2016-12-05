<h1>hoi</h1>

@foreach($maps as $map)
	<li>{{$map->id}}</li>
	<li>{{$map->name}}</li>
	<li>{{$map->floor}}</li>
	<li>{{$map->image}}</li>
@endforeach