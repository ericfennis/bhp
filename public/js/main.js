//de sources waar we later nog dingen aan toe willen voegen staan hier.
var iconSource = new ol.source.Vector({});
var routeSource = new ol.source.Vector({});

function addRoute(x1, y1, x2, y2){
	var coordinates = [[x1, y1], [x2, y2]]; 

	//de feature van deze route
	tempRouteFeature = new ol.Feature({
		geometry: new ol.geom.LineString(coordinates),
		name: 'Line'
	});
	routeSource.addFeature(tempRouteFeature);
}

function addIcon(icon, x, y){
	//de feature van dit icoon
	var tempIconFeature = 
		new ol.Feature({
			geometry: new ol.geom.Point([x, y]),
			name: 'Null Island',
			population: 4000,
			rainfall: 500,
			style: 
				new ol.style.Style({
					image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
						anchor: [0.5, 46],
						anchorXUnits: 'fraction',
						anchorYUnits: 'pixels',
						opacity: 0.75,
						src: icon
					}))
				})
		});

	//de style aanmaken van dit icoon
	var tempIconStyle = new ol.style.Style({
	  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
		anchor: [0.5, 46],
		anchorXUnits: 'fraction',
		anchorYUnits: 'pixels',
		opacity: 0.75,
		src: 'http://openlayers.org/en/v3.0.0/examples/data/icon.png'
	  }))
	});

	tempIconFeature.setStyle(tempIconStyle);
	iconSource.addFeature(tempIconFeature);
}


//var coordinates = [[[78.65, 800], [800, 800]], [[78.65, 800], [800, 100]]]; 
var extent = [0, 0, 1024, 1024];
var projection = new ol.proj.Projection({
  code: 'static-image',
  units: 'pixels',
  extent: extent
});
	

	var map = new ol.Map({
  	layers: [
		new ol.layer.Image({
			source: new ol.source.ImageStatic({
				url: '/img/plattegrond.png',
				projection: projection,
				imageExtent: extent
			})
		}),
	
		new ol.layer.Image({
			source: new ol.source.ImageStatic({
				url: '/img/plattegrond2.png',
				//tilePixelRatio: 2, // THIS IS IMPORTANT
				projection: projection,
				imageExtent: extent
			})
		}),

		new ol.layer.Vector({
			source: routeSource,
			style: new ol.style.Style({
				stroke: new ol.style.Stroke({
					color: '#ff0000',
					width: 10,
					lineCap: 0,	      
					lineDash: [10,5] 
				})
			})
		}),

		new ol.layer.Vector({
			source: iconSource
		})
	],
  	target: 'map',
  	view: new ol.View({
		projection: projection,
		center: ol.extent.getCenter(extent),
		minZoom: 2,
		maxZoom: 3,
		zoom: 2,
	})
});
