let map, infoWindow, drawingManager;

function initMap() {
    // Options for the map
    const mapOptions = {
        center: { lat: 6.9214, lng: 122.0790 },
        zoom: 6,
    };

    // Create the map instance
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    infoWindow = new google.maps.InfoWindow();

    const locationButton = document.createElement("button");

    locationButton.textContent = "Pan to Current Location";
    locationButton.classList.add("custom-map-control-button");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
    locationButton.addEventListener("click", () => {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    // Create a marker at the current location
                    const marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: "Current Location",
                    });

                    // Add a click event listener to the marker
                    marker.addListener("click", () => {
                        infoWindow.setPosition(pos);
                        infoWindow.setContent("This is the current location.");
                        infoWindow.open(map);
                    });

                    infoWindow.setPosition(pos);
                    infoWindow.setContent("Location found.");
                    infoWindow.open(map);
                    map.setCenter(pos);

                    // Create a polygon with sample coordinates
                    const samplePolygonCoordinates = [
                        { lat: 6.9674981, lng: 122.0467514 },
                        { lat: 6.9142233, lng: 122.0425935 },
                        { lat: 6.9391805, lng: 121.9914933 },
                        { lat: 6.9544422, lng: 121.9726062 },
                    ];

                    const polygon = new google.maps.Polygon({
                        paths: samplePolygonCoordinates,
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.35,
                    });

                    polygon.setMap(map);
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                },
            );
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    });

    // Initialize the drawing manager
    drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: null,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT,
            drawingModes: ['polygon', 'polyline'],
        },
        polygonOptions: {
            strokeColor: '#00FF00',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#00FF00',
            fillOpacity: 0.35,
        },
        polylineOptions: {
            strokeColor: '#0000FF',
            strokeOpacity: 0.8,
            strokeWeight: 2,
        },
    });

    // Set the drawing manager on the map
    drawingManager.setMap(map);

    // Add an event listener for when an overlay is complete
    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
        // Get the overlay (polygon or polyline) that was drawn
        const overlay = event.overlay;

        // Add the overlay to the map
        overlay.setMap(map);
    });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation ?
        "Error: The Geolocation service failed." :
        "Error: Your browser doesn't support geolocation.",
    );
    infoWindow.open(map);
}

window.initMap = initMap;