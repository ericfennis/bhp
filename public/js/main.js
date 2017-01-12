//iets met namespace
window.app = {};
var app = window.app;

//verscheidene benodigdheden voor routetekenen e.d.
var mode = '';
var defaultIconAction = 'none'
var iNum = 0;
var prevXY = [0, 0];
var prevPoint = 0;
var newRoute = [];

var currentFloor = 0;
var extent = [0, 0, 1024, 1024];
var projection = new ol.proj.Projection({
	code: 'static-image',
	units: 'pixels',
	extent: extent
});

//de sources waar we later nog dingen aan toe willen voegen staan hier.
var mapSource = new ol.source.ImageStatic({});
var routeSource = [new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({})];
var iconSource = [new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({})];
var letterSource = new ol.source.ImageStatic({});

//layers waar we later misschien nog aanspraak op willen maken?
var mapLayer = new ol.layer.Image({
	source: new ol.source.ImageStatic({
		projection: projection,
		imageExtent: extent
	})
});
var routeLayer = new ol.layer.Vector({
	source: routeSource[currentFloor],
	style: new ol.style.Style({
		stroke: new ol.style.Stroke({
			color: '#222222',
			width: 5,
			lineCap: 0,
			lineDash: [5,2.5]
		})
	})
});
var iconLayer = new ol.layer.Vector({
	source: iconSource[currentFloor]
});
var letterLayer = new ol.layer.Image({
	source: new ol.source.ImageStatic({
		projection: projection,
		imageExtent: extent
	})
});
function drawLine(x, y, point){
	if(prevXY[0] == 0 && prevXY[1] == 0){
		newRoute.push(point);
		prevXY = [x, y];
		prevPoint = point;
	}
	else{
		//grafisch uitbeelden!
		addRoute(currentFloor, prevXY[0], prevXY[1], x, y);

		console.info('from ' + prevPoint + ' to ' + point);
		newRoute.push(point);
		prevXY = [x, y];
		prevPoint = point;
	}
	if($("#json").length > 0){
		$("#json").val(JSON.stringify(newRoute));
	}
}

//de functies die de map inkleuren of besturen
function addRoute(floorNum, x1, y1, x2, y2){
	var coordinates = [[x1, y1], [x2, y2]];

	//de feature van deze route
	tempRouteFeature = new ol.Feature({
		geometry: new ol.geom.LineString(coordinates),
		name: 'Route'
	});
	routeSource[floorNum].addFeature(tempRouteFeature);
}
function addIcon(floorNum, icon, action, val, x, y){
	//de feature van dit icoon
	var tempIconFeature =
		new ol.Feature({
			geometry: new ol.geom.Point([x, y]),
			x: x,
			y: y,
			name: icon,
			map_id: floorNum,
			action: action,
			value: val,
		});

	//de style aanmaken van dit icoon
	var tempIconStyle = new ol.style.Style({
	  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
		anchor: [0.5, 0.5],
		//offset: 64,
		size: [32, 32],
		anchorXUnits: 'fraction',
		anchorYUnits: 'fraction',
		opacity: 0.75,
		scale: 1,
		//src: 'http://openlayers.org/en/v3.0.0/examples/data/icon.png'
		src: icon
	  }))
	});

	console.info('Adding icon at ' + x + '/' + y);
	tempIconFeature.setStyle(tempIconStyle);
	iconSource[floorNum].addFeature(tempIconFeature);
}
function delIcon(feature){
	$.get( "/api/point/del/" + feature.get('value'), function( data ) {
		if(data == "success"){			iconSource[feature.get('map_id')].removeFeature(feature);		}
		else{							alert(data);													}
	});
}
function getAllIcons(){
	//alle icons verwijderen door de icon-sources leeg te maken.
	for (i = 0; i < iconSource.length; i++) {
		iconSource[i].clear();
	}

	//vullen met db-punten
	$.get( "/api/point/list", function( data ) {
		data = JSON.parse(data);
		$.each(data, function(i, item) {
			addIcon(item['map_id'], '/img/icons/blackdot.png', defaultIconAction, item['id'], item['x'], item['y']);
		});
	});
}
function setMapSource(url){
	mapSource = new ol.source.ImageStatic({
		url: url,
		projection: projection,
		imageExtent: extent
	})
	mapLayer.setSource(mapSource);
}
function setLetterSource(url){
	letterSource = new ol.source.ImageStatic({
		url: url,
		projection: projection,
		imageExtent: extent
	})
	letterLayer.setSource(letterSource);
}
function setMode(newMode){
	switch(newMode) {
		case 'drawIcons':
			console.info("Switched to draw-icon-mode");
			mode = "drawIcons";
			defaultIconAction = "del-icon";
			getAllIcons(); //in deze modus hebben we de points nodig
			break;

		case 'drawRoutes':
			console.info("Switched to draw-route-mode");
			mode = "drawRoutes";
			defaultIconAction = "draw-line";
			getAllIcons(); //in deze modus hebben we de points nodig
			break;

		case 'setPoint':
			console.info("Switched to set-point-mode");
			mode = "setPoint";
			defaultIconAction = "set-point";
			getAllIcons(); //in deze modus hebben we de points nodig
			break;

		case '':	default:
			mode = '';
			defaultAction = '';
		break;
	}

}
function setRouteIconSource(floorNum){
	routeLayer.setSource(routeSource[floorNum]);
	iconLayer.setSource(iconSource[floorNum]);
}
function setFloor(floorNum){

	switch(floorNum) {
        case 3:             //switch naar verdieping 2
                            setMapSource("/img/floor3.png");
                            setLetterSource("/img/letters3.png");
                            floorNum = 3;
                            document.getElementById('select-floor-3').className = "select-floor-button active";
        break;

        case 2:             //switch naar verdieping 2
                            setMapSource("/img/floor2.png");
                            setLetterSource("/img/letters2.png");
                            floorNum = 2;
                            document.getElementById("select-floor-2").className = "select-floor-button active";
        break;

        case 1:             //switch naar verdieping 1
                            setMapSource("/img/floor1.png");
                            setLetterSource("/img/letters2.png");
                            floorNum = 1;
                            document.getElementById("select-floor-1").className = "select-floor-button active";
        break;

        case 0: default:    //switch naar beganegrond
                            setMapSource("/img/floor0.png");
                            setLetterSource("/img/letters1.png");
                            floorNum = 0;
                            document.getElementById("select-floor-0").className = "select-floor-button active";
        break;
    }
    currentFloor = floorNum;

	//afbeeldingen zijn omgezet, pak nu ook de juiste routes en iconen
	setRouteIconSource(floorNum);
	console.info("Switched to floor " + floorNum);
}

var map = new ol.Map({
  	layers: [mapLayer, routeLayer, iconLayer, letterLayer],
  	target: 'map',
  	view: new ol.View({
		projection: projection,
		center: ol.extent.getCenter(extent),
		minZoom: 1.5,
		maxZoom: 4,
		zoom: 1.7,
		center: [512, 485],
	})
});

//events
map.on('click', function(evt){
	var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');

	//moet hier één of andere gekke factor toepassen, anders trekken de x en y scheef? :/
	var lon = lonlat[0]*111319.49079327356;//naar rechts is groter
	var lat = lonlat[1]*111324.05140791999;//omhoog is kleiner

	//console.info('Click lonlat [' + lon + ', ' + lat + ']');

	//check of er een icoon op deze locatie staat
	if(map.hasFeatureAtPixel(evt.pixel)){

		//kijk per feature (op deze pixel) wat er moet gebeuren.
		map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
			//heeft deze feature een actie? zo ja: uitvoeren.
			switch(feature.get('action')) {
				case 'switch-floor':
					console.info('[Click] Feature switch-floor');
					setFloor(feature.get('value'))
				break;
				case 'draw-line':
					if(mode == 'drawRoutes'){
						console.info('[Click] Feature draw-line ' + feature.get('geometry')[0]);
						drawLine(feature.get('x'), feature.get('y'), feature.get('value'));
					}
					else {
						console.info('[Click] Line has not been drawn; check mapmode!');
					}
				break;
				case 'set-point':
					if(mode == 'setPoint'){
						console.info('[Click] setPoint ' + feature.get('value'));
						if($(".wp-field").length > 0){
							$(".wp-field").val(feature.get('value'));
						}
					}
					else {
						console.info('[Click] Point has not been selected; check mapmode!');
					}
				break;
				case 'del-icon':
					if(mode == 'drawIcons'){
						console.info('[Click] Feature remove ' + feature.get('value'));
						delIcon(feature);
					}
					else {
						console.info('[Click] Feature has not been removed; check mapmode!');
					}
				break;
				case 'popup-sightseeing':
					console.info('[Click] Feature sightsee');
					break;
				default:
					console.info('[Click] Feature [' + feature.get('name') + '] has unknown action [' + feature.get('action') + ']');
			}
		})
	}
	else {
		console.info('[Click] No features at pixel, lonlat ' + lon + ', ' + lat);
		if(mode == 'drawIcons'){
			//toevoegen en ID instellen op het icoon als VAL
			$.get( "/api/point/add/" + currentFloor + "/" + lon + "/" + lat, function( data ) {
				addIcon(currentFloor, '/img/icons/blackdot.png', 'del-icon', data, lon, lat);
			});
		}
	}

});
var setFloor_buttons = document.createElement('div');
setFloor_buttons.id = "floor-controll";
setFloor_buttons.className = 'select-floor ol-control ol-unselectable';

for (var fl_button = 0; fl_button <= 3; fl_button++) {
    var floorButton = document.createElement('button');
    floorButton.className = 'ol-unselectable select-floor-button';
    floorButton.id = 'select-floor-'+fl_button;
    floorButton.setAttribute('data',fl_button);
    floorButton.innerHTML = fl_button;
    setFloor_buttons.appendChild(floorButton);

}


function setButtonEvent(f) {
	console.log("buttonEvent aanmaken voor " + f);
	$("#select-floor-"+f).on("tap", function(event) {
 		event.preventDefault();
		setFloor(f);
	});

	$("#select-floor-"+f).on("click", function(event) {
 		event.preventDefault();
		setFloor(f);
	});
}

var buttonOverlay = new ol.control.Control({
    element: setFloor_buttons
});
map.addControl(buttonOverlay);

for (var floorEl = 0; floorEl <= 3; floorEl++) {
    setButtonEvent(floorEl);
}


$(document).ready(function(){
	if($("#json").length > 0){
		//$("#json").parent().parent().hide();
	}
});