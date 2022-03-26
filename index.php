<?php

$clientId = "";
$workspaceId = "";
$reportId = "";
$clientSecret = "";
$tenantId = '';

/* Get oauth2 token using a POST request */
$curlPostToken = curl_init();

curl_setopt_array($curlPostToken, array(
    CURLOPT_URL => "https://login.microsoftonline.com/$tenantId/oauth2/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array(
        'grant_type' => 'client_credentials',
        // 'grant_type' => 'password',
        'resource' => 'https://analysis.windows.net/powerbi/api',
        'client_id' => $clientId, // Registered App ApplicationID
        'client_secret' => $clientSecret
        // username => '', // for example john.doe@yourdomain.com
        // password => '' // Azure password for above user
    )
));

$tokenResponse = curl_exec($curlPostToken);
$tokenError = curl_error($curlPostToken);

curl_close($curlPostToken);

// decode result, and store the access_token in $embeddedToken variable:
$tokenResult = json_decode($tokenResponse, true);
$token = $tokenResult["access_token"];
$embeddedToken = "Bearer "  . ' ' .  $token;

/* Use the token to get an embedded URL using a GET request */
$curlGetUrl = curl_init();

$data_string = json_encode(["accessLevel" => "View"]); // json_encode(["accessLevel" => "View"]);

curl_setopt_array($curlGetUrl, array(
    CURLOPT_URL => "https://api.powerbi.com/v1.0/myorg/groups/$workspaceId/reports/$reportId/GenerateToken",
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data_string,
    CURLOPT_HTTPHEADER => array(
        "Authorization: $embeddedToken",
        "Content-Type: application/json",
    )
));

$embedResponse = curl_exec($curlGetUrl);
$embedError = curl_error($curlGetUrl);

curl_close($curlGetUrl);

if ($embedError) {
    echo "cURL Error #:" . $embedError;
} else {
    echo "<pre>";
    $embedResponse = json_decode($embedResponse, true);
    $embedUrl = $embedResponse['value'][0]['embedUrl']; // this is just taking the first value. you need logic to find the report you actually want to embed. This EmbedUrl needs to match the corresponding ReportId you later use in the JavaScript.
}
