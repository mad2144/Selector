<?php
header('Content-type: text/html; charset=utf-8');

$term = $_GET["term"];

$tuCurl = curl_init();

curl_setopt($tuCurl, CURLOPT_URL, "http://ws.spotify.com/search/1/track" . "?q=" . $term);
curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);

echo "<pre>";

echo htmlspecialchars(curl_exec($tuCurl));

echo "</pre>";

curl_close($tuCurl);
?>
