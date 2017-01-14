
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
        facilities: []
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
        this.getFacilities();
    },
    methods: {
        getWalkpath: function(item) {
                var resource = this.$resource('api/walkpath{/id}'),
                    itemID = null;

                if(item.company_id) {
                    itemID = item.company_id;

                } else if(item.id) {
                    itemID = item.id;
                }
                resource.get({id: itemID}).then((response) => {
                    this.walkPath = response.body;
                    drawWalkpath();
                });                
        },
        getFacilities: function() {
                this.$http.get('/api/facilities').then((response) => {
                    this.facilities = response.body;
                    setFacilities();
                }, (response) => {
                    console.error('Hij doet het niet');
                });
        },
        currentView: function() {
            return routes[this.currentRoute];
        },
        exitMap: function() {
            clearMap();
            flyToCenter();
            this.getFacilities();
        }

    },
    render (h) { 
        return h(this.ViewComponent) 
    }
    
});
    var t;
    var debugMode = false;
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
                }),
                container = document.getElementById('popups');

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
                        size: [32, 32],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'fraction',
                        opacity: 1,
                        scale: 1,
                        src: icon
                      }))
                    });

                    console.info('Adding icon');
                    tempIconFeature.setStyle(tempIconStyle);
                    iconSource[floorNum].addFeature(tempIconFeature);
                }
                function addFacility(floorNum, action, val, x, y){
                    //de feature van dit icoon
                    var icon = 'img/icons/';
                    switch(action) {
                        case 'start':
                            icon +='beginpunt.png';
                        break;
                        case 'switch-floor':
                            icon +='trap.svg';
                        break;
                        case 'toilet':
                            icon +='toilet.svg';
                        break;
                        case 'lift':
                            icon +='lift.svg';
                        break;
                    }
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
                        size: [32,32],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'fraction',
                        opacity: 1,
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
                    facilityLayer.setSource(facilitySource[floorNum]);
                    iconLayer.setSource(iconSource[floorNum]);
                }
                function setFloor(floorNum){
                    var floor_buttons = document.getElementsByClassName("select-floor-button");
                    var popUp = document.getElementsByClassName("ol-popup");
                    //console.log(popUp);
                    for (var fl = 0; fl <= 3; fl++) {
                        floor_buttons[fl].className = "select-floor-button";
                        if(popUp) {
                            popUp[fl] ? popUp[fl].style.display = 'none': '';
                        }
                    }
                    switch(floorNum) {
                        case 3:             //switch naar verdieping 2
                                            setMapSource("/img/floor3.png"); 
                                            setLetterSource("/img/letters3.png"); 
                                            floorNum = 3;
                                            floor_buttons[3].className = "select-floor-button active";
                                            popUp[3] ? popUp['popup-3'].style.display = 'block': '';
                        break;

                        case 2:             //switch naar verdieping 2
                                            setMapSource("/img/floor2.png"); 
                                            setLetterSource("/img/letters2.png"); 
                                            floorNum = 2;
                                            floor_buttons[2].className = "select-floor-button active"; 
                                            popUp[2] ? popUp['popup-2'].style.display = 'block': '';
                        break;

                        case 1:             //switch naar verdieping 1
                                            setMapSource("/img/floor1.png"); 
                                            setLetterSource("/img/letters2.png"); 
                                            floorNum = 1;
                                            floor_buttons[1].className = "select-floor-button active";
                                            popUp[1] ? popUp['popup-1'].style.display = 'block': '';
                        break;

                        case 0: default:    //switch naar beganegrond
                                            setMapSource("/img/floor0.png"); 
                                            setLetterSource("/img/letters1.png"); 
                                            floorNum = 0;
                                            floor_buttons[0].className = "select-floor-button active";
                                            popUp[0] ? popUp['popup-0'].style.display = 'block': '';
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
                        zoom: 2.1,
                        center: center,
                        extent: extent
                    });
                var map = new ol.Map({
                    layers: [mapLayer,facilityLayer,routeLayer,iconLayer,letterLayer],
                    target: 'map',
                    view: view,
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
                function addPopup(floor,func,text,coordinate) {
                    console.log(floor);
                     var popup = document.createElement('div');
                    popup.className = 'ol-popup';
                    popup.id = 'popup-'+floor;
                    popup.style.display = 'none';
                    //popup.setAttribute('data-floor',floor);
                    var overlay = [];
                    popup.innerHTML = '<div id="popup-content">'+text+'</div><a href="#" id="popup-action"  class="ol-popup-action">OK</a>';
                     overlay[floor] = new ol.Overlay(({
                        element: popup,
                        autoPan: true,
                        autoPanAnimation: {
                          duration: 250
                        }
                    }));
                     popup.ontouchstart=function() {
                        overlay[floor].setPosition(undefined);
                        func=='next-floor'?setFloor(floor+1):'';
                        popup.blur();
                        return false;
                    };
                     popup.onclick=function() {
                        overlay[floor].setPosition(undefined);
                        func=='next-floor'?setFloor(floor+1):'';
                        popup.blur();
                        return false;
                    };
                    
                    map.addOverlay(overlay[floor]);
                    overlay[floor].setPosition(coordinate);

                }
                function setFacilities() {

                    var facilities = App.facilities;
                    facilitySource = [new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({})];
                    
                    for (var i = 0; i < facilities.length; i++) {
                        var fac = facilities[i];
                        switch(fac.icon) {
                            case 'stairs-up':
                                addFacility(fac.floor,'switch-floor',fac.floor+1, fac.x, fac.y);
                            break;
                            case 'stairs-down':
                                addFacility(fac.floor,'switch-floor',fac.floor-1, fac.x, fac.y);
                            break;
                            case 'toilet':
                                addFacility(fac.floor,'toilet',0, fac.x, fac.y);
                            break;
                            case 'lift':
                                addFacility(fac.floor,'lift',0, fac.x, fac.y);
                            break;

                        }
                    }
                    addFacility(0, 'start', 0, 83,521);
                    setFloor(0);
                }

                function drawWalkpath() {
                    clearMap();

                    var points = App.walkPath;
                    var totalFloors = 0;
                    
                    
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

                                if((totalFloors - 1) > floor) {
                                    if((totalFloors - 1) !== floor) {
                                        var text = "Ga hier naar de volgende verdieping";
                                        addPopup(floor,'next-floor',text,[points[floor][lastInArray][0], points[floor][lastInArray][1]]);
                                    }
                                }
                                if((totalFloors - 1) == floor) {
                                    addIcon(floor, 'img/icons/eindpunt.svg', 'route-end', 0, points[floor][lastInArray][0], points[floor][lastInArray][1]);
                                    var text = "Hier is uw bestemming";
                                    addPopup(floor,null,text,[points[floor][lastInArray][0], points[floor][lastInArray][1]]);
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
                function clearMap() {
                    routeSource = [new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({})];
                    iconSource = [new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({}), new ol.source.Vector({})];
                    routeLayer.changed();
                    iconLayer.changed();
                    map.getOverlays().clear();
                    setFloor(0);
                    console.log("Clear!");
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