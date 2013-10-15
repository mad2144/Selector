<?php
header('Content-type: application/json; charset=utf-8');

$term = $_GET["term"];

$tuCurl = curl_init();

curl_setopt($tuCurl, CURLOPT_URL, "http://ws.spotify.com/search/1/artist.json" . "?q=" . $term);
curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);

$json = curl_exec($tuCurl);
$arr = json_decode($json, TRUE);
$values = array();
for($i = 0; $i < min(10, count($arr['artists'])); $i++) {
  $values[] = array("display" => $arr['artists'][$i]['name'], "value" => $arr['artists'][$i]['href']);
}
echo(json_encode($values));
curl_close($tuCurl);
?>
