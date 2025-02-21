
 //jQuery(document).ready(function ($) {
        

        // Reset map view to the default location
        function resetMap() {
            map.setCenter(fixedLocation);
            map.setZoom(mapzoom);  // Zoom out to the default level
            clearMarkers();  // Clear any existing markers
            clearGrid();  // Clear the grid of places
        }

        // Find nearby places based on selected category (restaurant, cafe, gym, etc.)
        function findNearbyPlaces(type,pos) {
            const request = {
                location: fixedLocation,  // Fixed location (Kochi, India)
                radius: 2000,  // 2 km radius
                keyword: type,  // Filter based on type (restaurant, cafe, gym)
            };

            //Add Active class to seleced button type
            
            jQuery('.btn_type').removeClass('active');
            jQuery('.btn_'+pos).addClass('active');



            console.log("Request Parameters:", request);  // Debugging request parameters
            service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, function(results, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    // Clear previous markers
                    clearMarkers();
                    clearGrid();
                    resetMap();

                    results.forEach(place => {
                        if (place.geometry && place.geometry.location) {
                            // Create AdvancedMarkerElement for each place
                            const advancedMarker = new google.maps.marker.AdvancedMarkerElement({
                                position: place.geometry.location,
                                map: map,
                                title: place.name,
                            });

                            // Store the marker in the markers array
                            markers.push(advancedMarker);

                            // Add place to the grid
                            addPlaceToGrid(place, advancedMarker);

                            // Prepare InfoWindow content with title, address, and directions link
                            const infoContent = `
                                <div class="info-window-content">
                                    <div class="close-btn" onclick="closeInfoWindow()">X</div>
                                    <h3>${place.name}</strong></h3>
                                    <p>${place.vicinity ? place.vicinity : 'No address available'}</p>
                                    <p><a href="https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(place.vicinity)}" target="_blank">Get Directions</a></p>
                                </div>
                            `;

                            // Attach event listener for click
                            advancedMarker.addListener("click", function() {
                                infowindow.setContent(infoContent);  // Set InfoWindow content with title, address, and directions
                                infowindow.open(map, advancedMarker);
                            });
                        }
                    });
                } else {
                    console.error('Places API error:', status);
                    alert(`Error: ${status}`);
                }
            });
        }



        // Add place to the grid at the bottom
        function addPlaceToGrid(place, marker) {
            const placeCard = document.createElement("div");
            placeCard.classList.add("place-card");

            const title = document.createElement("h3");
            title.textContent = place.name;

            const address = document.createElement("p");
            address.textContent = place.vicinity || 'No address available';

            // Add click event to center the map on this place when clicked
            placeCard.addEventListener("click", function() {
                map.setCenter(place.geometry.location);
                map.setZoom(16);
                infowindow.setContent(`
                    <div class="info-window-content">
                                    <div class="close-btn" onclick="closeInfoWindow()">X</div>
                                    <h3>${place.name}</h3>
                                    <p>${place.vicinity ? place.vicinity : 'No address available'}</p>
                                    <p><a href="https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(place.vicinity)}" target="_blank">Get Directions</a></p>
                                </div>
                `);
                infowindow.open(map, marker);  // Open InfoWindow at the marker position
            });

            placeCard.appendChild(title);
            placeCard.appendChild(address);

            // Append the card to the places grid
            document.getElementById("places-list").appendChild(placeCard);
        }
        // Clear existing markers from the map
        function clearMarkers() {
            // Remove each marker from the map and empty the markers array
            markers.forEach(marker => {
                marker.setMap(null);  // Remove marker from map
            });
            markers = [];  // Clear the marker array
        }
        // Function to close InfoWindow
        function closeInfoWindow() {
            infowindow.close();  // Close the InfoWindow
        }
        // Clear the places grid
        function clearGrid() {
            const placesList = document.getElementById("places-list");
            placesList.innerHTML = '';  // Clear all grid items
        }
//});