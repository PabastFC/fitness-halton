<?php
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

echo '<response>';

	$arySport = array(
		"All Sporting Locations" => "http://mobile.sheridanc.on.ca/~gjebero/Hackathon/parks.kml",
		"Baseball" => "http://mobile.sheridanc.on.ca/~gjebero/Hackathon/baseball.kml",
		"Basketball" => "http://mobile.sheridanc.on.ca/~gjebero/Hackathon/basketball.kml",
		"Cycling" => "http://mobile.sheridanc.on.ca/~takharp/hackathon/cycling.kml",
		"Hockey" => "http://mobile.sheridanc.on.ca/~gjebero/Hackathon/hockey.kml",
		"Soccer" => "http://mobile.sheridanc.on.ca/~gjebero/Hackathon/soccer.kml",
		"Swimming" => "http://mobile.sheridanc.on.ca/~gjebero/Hackathon/swimming.kml",
		"Tennis" => "http://mobile.sheridanc.on.ca/~gjebero/Hackathon/tennis.kml",
		"Volleyball" => "http://mobile.sheridanc.on.ca/~gjebero/Hackathon/volleyball.kml"
		);

	$selectedKml = $arySport[$_GET['sport']];
	echo $selectedKml;

echo '</response>';




?>