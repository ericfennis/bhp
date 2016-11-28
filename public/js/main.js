// Map views always need a projection.  Here we just want to map image
      // coordinates directly to map coordinates, so we create a projection that uses
      // the image extent in pixels.
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