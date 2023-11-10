<?php
if (isset($_POST['selectedCountry'])) {
    $selectedCountry = $_POST['selectedCountry']; // Replace with a valid country code, e.g., "US" for the United States

    $getdirections = "http://api.geonames.org/countryInfo?username=johnmicheal2023";

    $ch = curl_init($getdirections);

    // Set cURL options to return the response as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL session and get the XML response
    $xmlResponse = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        exit;
    }

    // Parse the XML response
    $xml = simplexml_load_string($xmlResponse);

    if ($xml === false) {
        echo json_encode(array('error' => 'Failed to fetch country information'));
    } else {
        $found = false;
        $countryCode = '';
        $north = '';
        $west = '';
        $south = '';
        $east = '';

        // Loop through the countries in the XML
        foreach ($xml->country as $country) {
            if ($country->countryCode == $selectedCountry) {
                $found = true;
                $countryCode = $country->countryCode;
                $north = $country->north;
                $west = $country->west;
                $south = $country->south;
                $east = $country->east;
                break;
            }
        }

        if ($found) {
            // Use the extracted values to construct the weather API endpoint
            $weatherApiEndpoint = "http://api.geonames.org/weatherJSON?north=$north&south=$south&east=$east&west=$west&username=johnmicheal2023";

            // Initialize cURL session for weather data
            curl_setopt($ch, CURLOPT_URL, $weatherApiEndpoint);

            // Execute the cURL session and get the JSON response for weather data
            $weatherResponse = curl_exec($ch);

            // Validate and send the JSON response to the client
            if ($weatherResponse === false) {
                echo json_encode(array('error' => 'Failed to fetch weather data'));
            } else {
                echo $weatherResponse;
            }
        } else {
            echo json_encode($xml);
        }
    }

    // Close cURL session
    curl_close($ch);
} else {
    echo "Selected country not provided.";
}
