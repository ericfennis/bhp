
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var ol = require('./ol');

window.Vue = Vue;

require('./modules/vue-keyboard');

import routes from './routes'

const NotFound = { template: '<p>Page not found</p>' }


var App = window.App = new Vue({

    el: '#app',
    data: {
    	currentRoute: window.location.pathname,

    	walkPath: [],
  	},
    computed: {
	    ViewComponent () {
			const matchingView = routes[this.currentRoute]
			return matchingView
			? require('./pages/' + matchingView + '.vue')
			: require('./pages/404.vue');
		}
	  },
	created() {
    	console.log('vue loaded');
    },
    methods: {
    	getWalkpath: function(item) {
                var resource = this.$resource('api/walkpath{/id}'),
                	itemID = null;

				  // GET someItem/1
				  if(item.company_id) {
                    	//console.log(item.company_id);
                    	itemID = item.company_id;

	                } else if(item.id) {
	                    //console.log(item.id);
	                    itemID = item.id;
	                }
				  resource.get({id: itemID}).then((response) => {
				    this.walkPath = response.body;
                    //console.log(this.walkPath);
                    drawWalkpath();
				  });                
        },
        currentView: function() {
            return routes[this.currentRoute];
        },
        exitMap: function() {
            flyToCenter();
        }

    },
	render (h) { 
        return h(this.ViewComponent) 
    }
    
});
    var t;
    var debugMode = true
    window.onload = resetTimer;
    // DOM Events
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;

    function goToHome() {
        App.currentRoute = '/';
        App.exitMap();
        console.log("Home set");
    }

    function resetTimer() {
        clearTimeout(t);
        if(App.currentView() == "List" && debugMode == false) {
            t = setTimeout(goToHome, 30000)
        }
        // 1000 milisec = 1 sec
    }
                //verscheidene bijnodigdheden voor routetekenen e.d.
                var drawRoutes = false,
                drawIcons = false,
                iNum = 0,
                prevXY = [0, 0],
                prevPoint = 0,
                newRoute = [],
                //openlayers settings
                currentFloor = 0,
                extent = [-420, 0, 1024, 960],
                imageExtent = [0, 0, 1024, 1024],
                center = [240, 485],
                projection = new ol.proj.Projection({
                    code: 'static-image',
                    units: 'pixels',
                    extent: imageExtent
                }),

                //de sources waar we later nog dingen aan toe willen voegen staan hier.
                mapSource = new ol.source.ImageStatic({}),
                routeSource = [new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({})],
                iconSource = [new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({})],
                facilitySource = [new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({})],
                letterSource = new ol.source.ImageStatic({}),

                //layers waar we later misschien nog aanspraak op willen maken?
                mapLayer = new ol.layer.Image({
                    source: new ol.source.ImageStatic({
                        projection: projection,
                        imageExtent: extent
                    })
                }),
                routeLayer = new ol.layer.Vector({
                    source: routeSource[currentFloor],
                    style: new ol.style.Style({
                        stroke: new ol.style.Stroke({
                            color: '#222222',
                            width: 5,
                            lineCap: 0,       
                            lineDash: [5,2.5]
                        })
                    })
                }),
                iconLayer = new ol.layer.Vector({
                    source: iconSource[currentFloor]
                }),
                facilityLayer = new ol.layer.Vector({
                    source: facilitySource[currentFloor]
                }),
                letterLayer = new ol.layer.Image({
                    source: new ol.source.ImageStatic({
                        projection: projection,
                        imageExtent: imageExtent
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
                }

                //de functies die de map inkleuren of besturen
                function addRoute(floorNum, x1, y1, x2, y2){
                    var coordinates = [[x1, y1], [x2, y2]]; 

                    //de feature van deze route
                    var tempRouteFeature = new ol.Feature({
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

                    console.info('Adding icon');
                    tempIconFeature.setStyle(tempIconStyle);
                    iconSource[floorNum].addFeature(tempIconFeature);
                }
                function addFacility(floorNum, icon, action, val, x, y){
                    //de feature van dit icoon
                    var tempFacilityFeature = 
                        new ol.Feature({
                            geometry: new ol.geom.Point([x, y]),
                            x: x,
                            y: y,
                            name: icon,
                            action: action,
                            value: val,
                        });

                    //de style aanmaken van dit icoon
                    var tempFacilityStyle = new ol.style.Style({
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

                    console.info('Adding icon');
                    tempFacilityFeature.setStyle(tempFacilityStyle);
                    facilitySource[floorNum].addFeature(tempFacilityFeature);
                }
                function setMapSource(url){
                    mapSource = new ol.source.ImageStatic({
                        url: url,
                        projection: projection,
                        imageExtent: imageExtent
                    })
                    mapLayer.setSource(mapSource);
                }
                function setLetterSource(url){
                    letterSource = new ol.source.ImageStatic({
                        url: url,
                        projection: projection,
                        imageExtent: imageExtent
                    })
                    letterLayer.setSource(letterSource);
                }
                function setRouteIconSource(floorNum){
                    routeLayer.setSource(routeSource[floorNum]);
                    iconLayer.setSource(iconSource[floorNum]);
                }
                function setFloor(floorNum){
                    var floor_buttons = document.getElementsByClassName("select-floor-button");
                    for (var fl = 0; fl <= 3; fl++) {
                        floor_buttons[fl].className = "select-floor-button";
                    }
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
                 var view = new ol.View({
                        projection: projection,
                        minZoom: 1.5,
                        maxZoom: 3,
                        zoom: 1.7,
                        center: center,
                        extent: extent
                    });
                var map = new ol.Map({
                    layers: [mapLayer, routeLayer, iconLayer,facilityLayer, letterLayer],
                    target: 'map',
                    view: view
                });
                var mapReload = '';

                //events
                map.on('click', function(evt){
                    var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');

                    //moet hier één of andereg gekke factor toepassen, anders trekken de x en y scheef? :/
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
                                    console.info('[Click] Feature draw-line ' + feature.get('geometry')[0]);
                                    drawLine(feature.get('x'), feature.get('y'), feature.get('value'));
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
                        if(drawIcons == true){
                            addIcon(currentFloor, 'img/icons/blackdot.png', 'draw-line', iNum++, lon, lat);
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
             
                function selectFloor(f) {
                    document.getElementById("select-floor-"+f).onclick=function() {
                        setFloor(f);
                    };
                    document.getElementById("select-floor-"+f).touchstart=function() {
                        setFloor(f);
                    };
                }
                var buttonOverlay = new ol.control.Control({
                    element: setFloor_buttons
                });
                map.addControl(buttonOverlay);

                for (var floorEl = 0; floorEl <= 3; floorEl++) {
                    selectFloor(floorEl);
                }

                //teken de toiletten
                addFacility(0, 'img/icons/WC (Fill).png', 'toilet', 0, 182.8882180970813, 269.8107913554641);
                addFacility(0, 'img/icons/WC (Fill).png', 'toilet', 0, 359.6649133937186, 454.37322191372243);

                //teken alles op de begane grond

                // addFacility(0, 'img/icons/Beginpunt (Fill).png', 'route-begin', 0, 87.25517739600188, 515.7997405507241);
                // addRoute(0, 87.25517739600188, 515.7997405507241, 181.77255084989517, 520.089303008371);
                // addRoute(0, 181.77255084989517, 520.089303008371, 191.12767140564603, 425.24956209240486);
                // addRoute(0, 191.12767140564603, 425.24956209240486, 211.60076314383846, 331.1205132058271);
                 addFacility(0, 'img/icons/Trap (Fill).png', 'switch-floor', 1, 211.60076314383846, 331.1205132058271);//trap omhoog naar v1

                // //teken alles op de eerste verdieping
                 addFacility(1, 'img/icons/Trap (Fill).png', 'switch-floor', 0, 211.60076314383846, 331.1205132058271);//trap omlaag naar bg
                 addFacility(1, 'img/icons/Trap (Fill).png', 'switch-floor', 2, 260.60076314383846, 351.1205132058271);//trap omhoog naar v1

                // //teken alles op de eerste verdieping
                 addFacility(2, 'img/icons/Trap (Fill).png', 'switch-floor', 1, 260.60076314383846, 351.1205132058271);//trap omlaag naar bg
                // addRoute(1, 211.60076314383846, 331.1205132058271, 217.8126787429306, 260.46886477583973);
                // addRoute(1, 217.8126787429306, 260.46886477583973, 425.8198910658566, 276.94793979000525);
                // addRoute(1, 425.8198910658566, 276.94793979000525, 415.9707357590965, 369.28755355025527);
                // addRoute(1, 415.9707357590965, 369.28755355025527, 436.9001907859601, 371.7499432498958);
                // addRoute(1, 436.9001907859601, 371.7499432498958, 426.32169461714, 464.5669774843762);
                // addFacility(1, 'img/icons/Eindbestemming (Fill).png', 'route-end', 0, 426.32169461714, 464.5669774843762);

                //herkenninspunt op verdieping 1
                addFacility(1, 'img/icons/WC (Fill).png', 'popup-sightseeing', 0, 425.8198910658566, 276.94793979000525);

                function drawWalkpath() {
          
                    var points = App.walkPath;
                    var totalFloors = 0;
                    //var floorDest
                     routeSource = [new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({})];
                     iconSource = [new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({})];
                    
                    if(points.length !== 0) {
                        //voor elke verdieping een getekende pad.
                        for (var pointArray = 0; pointArray < points.length; pointArray++) {
                            if(points[pointArray].length !== 0) {
                                totalFloors++;
                            }
                        }
                        console.log("vloeren:"+totalFloors);
                        for (var floor = 0; floor < points.length; floor++) {

                            if(points[floor].length !== 0) {
                            // laatste object in array
                                var lastInArray = points[floor].length -1;
                                // console.log(points[floor].length);
                                if(floor == 0) {
                                    //set startpunt
                                    addIcon(0, 'img/icons/beginpunt_zw.png', 'route-begin', 0, points[floor][0][0], points[floor][0][1]);
                                }
                                // if(points.length > 1) {
                                //     //console.log(points[floor][last_obj][0]);
                                //     if((points.length - 1) !== floor){
                                //         addIcon(floor, 'img/icons/Trap (Line).png', 'switch-floor', floor+1, points[floor][lastInArray][0], points[floor][lastInArray][1]);
                                //     }
                                    

                                //     if(floor !== 0) {
                                //         addIcon(floor, 'img/icons/Trap (Line).png', 'switch-floor', floor-1, points[floor][0][0], points[floor][0][1]);
                                //     }
                                    
                                // }
                                if((totalFloors - 1) == floor) {
                                    addIcon(floor, 'img/icons/Eindbestemming (Fill).png', 'route-end', 0, points[floor][lastInArray][0], points[floor][lastInArray][1]);
                                    //console.log(floor);
                                }
                                var tempRouteFeature = new ol.Feature({
                                        geometry: new ol.geom.LineString(points[floor]),
                                        name: 'Route'
                                });
                                routeSource[floor].addFeature(tempRouteFeature);
                            }
                        }
                        flyToCenter();
                        setFloor(0);
                    }
                }

                function flyToCenter() {
                    var duration = 720;
                    var zoom = 1.7;
                    var rotation = 0;
                    var parts = 2;
                    var called = false;
                    var viewCenter = view.getCenter();
                    if (viewCenter[0] !== center[0] && viewCenter[1] !== center[1]) {
                        function callback(complete) {
                          --parts;
                          if (called) {
                            return;
                          }
                          if (parts === 0 || !complete) {
                            called = true;
                          }
                        }
                        view.animate({
                          center: center,
                          duration: duration,
                          rotation: rotation
                        }, callback);
                        view.animate({
                          zoom: zoom - .1,
                          duration: duration / 2
                        }, {
                          zoom: zoom,
                          duration: duration / 2
                        }, callback);
                    }

                  }

                //alles bedacht, stel zichtbare verdieping in
                setFloor(0);