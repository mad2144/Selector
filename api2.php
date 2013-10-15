<?php
header('Content-type: application/json; charset=utf-8');

$term = $_GET["term"];

$tuCurl = curl_init();

curl_setopt($tuCurl, CURLOPT_URL, "http://ws.spotify.com/search/1/track" . "?q=" . $term);
curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);

$xml = new SimpleXMLElement(curl_exec($tuCurl));
$json = json_encode($xml);
$arr = json_decode($json, TRUE);
$values = array();
for($i = 0; $i < min(10, count($arr['track'])); $i++) {
  $values[] = array("display" => $arr['track'][$i]['name'], "value" => $arr['track'][$i]['@attributes']['href']);
}
echo(json_encode($values));
curl_close($tuCurl);
?>
