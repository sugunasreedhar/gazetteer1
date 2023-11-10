<?php include('function.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GAZETTEER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/maplibre-gl@3.3.0/dist/maplibre-gl.css" />
    <link rel="stylesheet" href="assets/css/main.css?v=131233">

</head>
<body>
    
<div class="loading">Loading&#8230;</div>

    <nav class="navbar navbar-expand-lg bg-light text-center">
        <a class="navbar-brand" href="index.php">GAZETTEER</a>
    </nav>

    <section class="main-content mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="formSec">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <form action="">
                                    <div class="form-group">
                                        <label for="">Select Country</label>
                                        <select name="" class="form-control" id="selectedCountry">
                                        <?php
                                            foreach ($countries as $country) {
                                                $isoCode = $country['iso_a2'];
                                                $countryName = $country['name'];
                                                echo "<option value=\"$isoCode\">$countryName</option>";
                                            }
                                        ?>
                                        </select>
                                        
                                    </div>
                                </form> 
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="popup-buttons">
                        <p><button id="countryInfoButton" class="btn btn-dark w-100" data-toggle="modal" data-target="#countryInfoModal">Country Info</button> </p>
                        <p><button id="weatherButton" class="btn btn-dark w-100" data-toggle="modal" data-target="#weatherModal">Weather</button></p>
                        <p><button id="wikiButton" class="btn btn-dark w-100" data-toggle="modal" data-target="#wikiModal">Wikipedia</button></p>
                    </div>
                </div>
                <div class="col-md-10">
                    <div id="map"></div> 
                </div>
            </div>
        </div>
    </section>



    <div class="modal fade" id="countryInfoModal" tabindex="-1" role="dialog" aria-labelledby="countryInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content"> 
                <div class="modal-body">
                <div class="topDetails">
                    <img id="country-flag" src=""><br>
                    <h5>
                        <span id="general-info-title"></span>
                    </h5>
                </div>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Region</td>
                                <td><span id="region"></span></td>
                            </tr>
                            <tr>
                                <td>Sub Region</td>
                                <td><span id="sub-region"></span></td>
                            </tr>
                            <tr>
                                <td>Time Zone</td>
                                <td><span id="timezones"></span></td>
                            </tr>
                            <tr>
                                <td>Capital city</td>
                                <td><span id="capital-city"></span></td>
                            </tr>
                            <tr>
                                <td>Lanugages spoken</td>
                                <td><span id="languages-spoken"></span></td>
                            </tr>
                            <tr>
                                <td>Currency</td>
                                <td><span id="currencies"></span></td>
                            </tr>
                            <tr>
                                <td>Currency Exchange Rate</td>
                                <td><span id="currenciesExchangeRate"></span></td>
                            </tr>
                            <tr>
                                <td>Population</td>
                                <td><span id="population"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
 

    <div class="modal fade" id="wikiModal" tabindex="-1" role="dialog" aria-labelledby="wikiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wikiModalLabel">Wikipedia Information</h5> 
                </div>
                <div class="modal-body">
                    <!-- Wikipedia information will be displayed here -->
                    <div id="wiki-info"></div>
                </div> 
            </div>
        </div>
    </div>

    

    <div class="modal fade" id="weatherModal" tabindex="-1" role="dialog" aria-labelledby="weatherModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="weatherModalLabel">Weather Information</h5> 
                </div>
                <div class="modal-body">
                    <!-- Weather information will be displayed here -->
                    <div id="weather-info"></div>
                </div> 
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js" integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"></script>
    <script src="https://unpkg.com/maplibre-gl@3.3.0/dist/maplibre-gl.js"></script>

    <script src="assets/js/main.js"></script>

   

  <script>
     
     $(document).ready(function () {


    const accessToken = 'mp7HpF6CTTab9XpRyyepuWcxb0csyu4kTS74Jx2iLGHnM7RsR2kkmnEz3vWCLjRq';
    const map = L.map('map').setView([0, 0], 2); // Set initial view to a neutral location
    let tileLayer;
    let userLocationMarker;
    let countryBordersLayer;

    // Function to fetch the user's current location and display their country's border
    function showUserLocationAndBorder() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Reverse geocoding to get the user's country name
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`)
                .then(response => response.json())
                .then(data => {
                    const isoCode = data.address.country_code.toUpperCase();
                    displayCountryBorders(isoCode);

                    // Call the function to display the user's location on the map
                    showUserLocation(position);
                })
                .catch(error => console.error("Error fetching location data:", error));
        });
    } else {
        alert("Geolocation is not supported by your browser.");
    }
    }

    // Call the function to get the user's location and display their country's border on page load
    showUserLocationAndBorder();

    // Function to display the user's location on the map and hide the loader
    function showUserLocation(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        if (userLocationMarker) {
            map.removeLayer(userLocationMarker); // Remove the previous marker if it exists
        }

        userLocationMarker = L.marker([latitude, longitude]).addTo(map);
        
        // Reverse geocoding to get the country name
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`)
            .then(response => response.json())
            .then(data => {
                const countryName = data.address.country;

                // Update the select element to preselect the user's country
                const selectCountry = document.getElementById('selectedCountry');
                const isoCode = data.address.country_code.toUpperCase();

                for (const option of selectCountry.options) {
                    if (option.value === isoCode) {
                        option.selected = true;
                        break;
                    }
                }

                userLocationMarker.bindPopup(`You are in ${countryName}`).openPopup();

                // Hide the loading element
                const loadingElement = document.querySelector('.loading');
                loadingElement.style.display = 'none';

                // Set the map location to the user's location
                map.setView([latitude, longitude], 9);

                // Add the map layer
                if (!tileLayer) {
                    tileLayer = L.tileLayer(
                        `https://tile.jawg.io/jawg-dark/{z}/{x}/{y}.png?access-token=${accessToken}`, {
                            attribution: '<a href="http://jawg.io" title="Tiles Courtesy of Jawg Maps" target="_blank" class="jawg-attrib">&copy; <b>Jawg</b>Maps</a> | <a href="https://www.openstreetmap.org/copyright" title="OpenStreetMap is open data licensed under ODbL" target="_blank" class="osm-attrib">&copy; OSM contributors</a>',
                            maxZoom: 4
                        }
                    ).addTo(map);
                }
            })
            .catch(error => console.error("Error fetching location data:", error));
    }




    // Load the GeoJSON data
    function displayCountryBorders(selectedIsoCode) {
        if (countryBordersLayer) {
            map.removeLayer(countryBordersLayer); // Remove the previous borders if they exist
        }

        // Load the GeoJSON data for the selected country
        fetch('countryBorders.geo.json')
            .then(response => response.json())
            .then(data => {
                // Filter the features to find the selected country by ISO code
                const selectedCountryFeature = data.features.find(feature => feature.properties.iso_a2 === selectedIsoCode);

                if (selectedCountryFeature) {
                    countryBordersLayer = L.geoJSON(selectedCountryFeature).addTo(map);
                    map.fitBounds(countryBordersLayer.getBounds());
                }
            })
            .catch(error => console.error("Error loading country boundaries:", error));
    }



    // Add an event listener to the select element to change the map location when a country is selected
    const selectCountry = document.getElementById('selectedCountry');
    selectCountry.addEventListener('change', function () {
        const selectedIsoCode = this.value;
        displayCountryBorders(selectedIsoCode);
        

        // Perform reverse geocoding to get the coordinates for the selected country
        fetch(`https://nominatim.openstreetmap.org/search?country=${selectedIsoCode}&format=json`)
            .then(response => response.json())
            .then(data => {
                if (data && data[0] && data[0].lat && data[0].lon) {
                    const latitude = parseFloat(data[0].lat);
                    const longitude = parseFloat(data[0].lon);

                    // Set the map location to the selected country
                    map.setView([latitude, longitude], 6);
                }
            })
            .catch(error => console.error("Error fetching location data:", error));
    });









  // Bellow code is to fetch Country Info and Currency details
    $("#countryInfoButton").click(function () {
        if ($("#selectedCountry").val() == "") {
            alert("Select the country first.");
        } else {
            $(document).ajaxStart(function () {
                $(".loading").show();
            });

            $.ajax({
                url: "scripts/restCountries.php",
                type: "POST",
                dataType: "json",
                data: {
                    q: $("#selectedCountry").val(),  
                },
                success: function (result) {
                   
                    console.log(result[0]);
                        // Extract capital, language, and currency information
                    
                        var languages = result.languages;
                        var currencies = result.currencies;
                    
                        

                        // "population" field is already numeric
                        var population = new Intl.NumberFormat().format(result.population);

                        var countryName = result[0].name.common;
                        var countryFullName = result[0].name.official;
                        // Update your modal content with the retrieved information
                        $("#region").html(result[0].region);
                        $("#sub-region").html(result[0].subregion);
                        $("#timezones").html(result[0].timezones[0]);
                        $("#general-info-title").html(countryName + '<br>' + countryFullName);
                        $("#capital-city").html(result[0].capital[0]);
                        $("#population").html(result[0].population.toLocaleString());
                        $("#country-flag").attr("src", result[0].flags.png); // contains the image URL
                        
                        var languagesInfo = "";
                        var languages = result[0].languages;

                        for (var languageCode in languages) {
                            if (languages.hasOwnProperty(languageCode)) {
                                var languageName = languages[languageCode];
                                languagesInfo += languageName + ' - ';
                            }
                        }

                        $("#languages-spoken").html(languagesInfo);

                        var currenciesInfo = "";
                        var currencies = result[0].currencies;

                        for (var currencyCode in currencies) {
                            if (currencies.hasOwnProperty(currencyCode)) {
                                var currency = currencies[currencyCode];
                                currenciesInfo += currency.name + ' - ' + currency.symbol + '<br>';
                            }
                        }

                        var currenciesData = result[0].currencies ;

                  
                        var currencyCode = Object.keys(currenciesData)[0];
                        console.log(currencyCode); 
                        
                        $("#currencies").html(currenciesInfo);
                        $.ajax({
                            url: "scripts/currencyExchange.php",
                            type: "GET",
                            data: {
                                base_currency: "USD",  
                                target_currency: currencyCode,   
                            },
                            success: function (exchangeRate) {
                                console.log(exchangeRate)
                               
                                $("#currenciesExchangeRate").html(exchangeRate);
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.log("Error fetching currency exchange rate");
                            },
                        });




                    $("#general-info-modal").modal("show");
                
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("data not sent");
                    console.log(errorThrown);
                    console.log(textStatus);
                    console.log(jqXHR);
                },
                complete: function () {
                    console.log('complete'); 
                    $(document).ajaxStop(function () {
                        $(".loading").hide();
                    });
                },
            });
        }
    });





    // Bellow code is to fetch weather data
    $("#wikiButton").click(function () {
        if ($("#selectedCountry").val() == "") {
            alert("Select the country first.");
        } else {
            // Show loading spinner
            $(".loading").show();
 
            $.ajax({
                url: "scripts/wiki.php",  
                type: "POST",
                dataType: "xml",
                data: {
                    selectedCountry: $("#selectedCountry").val(),
                },
                success: function (result) {
                  
                    const wikiModal = $("#wikiModal");
                    const wikiInfo = $("#wiki-info");
                    console.log(result);
                   
                      wikiInfo.empty();

                  
                    $(result).find('entry').each(function() {
                        const title = $(this).find('title').text();
                        const summary = $(this).find('summary').text();
                        const feature = $(this).find('feature').text();
                        const countryCode = $(this).find('countryCode').text();
                        const elevation = $(this).find('elevation').text();
                        const lat = $(this).find('lat').text();
                        const lng = $(this).find('lng').text();
                        const wikipediaUrl = $(this).find('wikipediaUrl').text();
                        const thumbnailImg = $(this).find('thumbnailImg').text();
                        
                        // Create HTML elements to display the information
                        const entryDiv = $("<div>");
                        entryDiv.append("<h2>" + title + "</h2>");
                        entryDiv.append("<p><strong>Summary:</strong> " + summary + "</p>");
                        entryDiv.append("<p><strong>Feature:</strong> " + feature + "</p>");
                        entryDiv.append("<p><strong>Country Code:</strong> " + countryCode + "</p>");
                        entryDiv.append("<p><strong>Elevation:</strong> " + elevation + "</p>"); 
                        entryDiv.append("<img src='" + thumbnailImg + "' alt='Thumbnail Image'>");
                        entryDiv.append("<p><a href='" + wikipediaUrl + "' target='_blank' class='btn btn-dark'>Read More</a></p>");

                        // Append the entry to the modal content
                        wikiInfo.append(entryDiv);
                    });


                    // Show the modal
                    wikiModal.modal("show");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("Error fetching wikipedia data");
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                complete: function () {
                    // Hide loading spinner
                    $(".loading").hide();
                },
            });
        }
    });




    //fetch weather data 
    $("#weatherButton").click(function () {
        if ($("#selectedCountry").val() == "") {
            alert("Select the country first.");
        } else {
         
            $(".loading").show();

        
            $.ajax({
                url: "scripts/weather.php", 
                type: "POST",
                dataType: "json",
                data: {
                    selectedCountry: $("#selectedCountry").val(),
                },
                success: function (result) {
                    
                    const weatherModal = $("#weatherModal");
                    const weatherInfo = $("#weather-info");
                    console.log(result);
                    weatherInfo.empty();
                    if (result.weatherObservations && result.weatherObservations.length > 0) {
                    const firstObservation = result.weatherObservations[0];

                    
                    const observationInfo = $("<div class='observation-info'></div>");
                    observationInfo.append("<p><strong>Observation:</strong> " + firstObservation.observation + "</p>");
                    observationInfo.append("<p><strong>Station Name:</strong> " + firstObservation.stationName + "</p>");
                    observationInfo.append("<p><strong>Temperature:</strong> " + firstObservation.temperature + "°C</p>");
                    observationInfo.append("<p><strong>Dew Point:</strong> " + firstObservation.dewPoint + "°C</p>");
                    observationInfo.append("<p><strong>Humidity:</strong> " + firstObservation.humidity + "%</p>");
                    observationInfo.append("<p><strong>Weather Condition:</strong> " + firstObservation.weatherCondition + "</p>");
                    observationInfo.append("<p><strong>Clouds:</strong> " + firstObservation.clouds + "</p>");
                    observationInfo.append("<p><strong>Wind Speed:</strong> " + firstObservation.windSpeed + "KT</p>");
                    observationInfo.append("<p><strong>Date and Time:</strong> " + firstObservation.datetime + "</p>");

                     
                    weatherInfo.append(observationInfo);
                } else {
                    weatherInfo.append("<p>No weather observations available for the selected country.</p>");
                }
                     
                    
                    // Show the modal
                    weatherModal.modal("show");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("Error fetching weather data");
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                complete: function () {
                    // Hide loading spinner
                    $(".loading").hide();
                },
            });
        }
    });








});



        
    </script>

</body>
</html>