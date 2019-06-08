<?php
const OVERFLOW = 50;
const URL = "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/1.0_month.csv";

$image = imagecreatefromjpeg(dirname(__FILE__)."/earthmap.jpg");
$quake = imagecreatefrompng(dirname(__FILE__)."/quake.png");

imagesetclip($image, -OVERFLOW, -OVERFLOW, imagesx($image)+OVERFLOW, imagesy($image)+OVERFLOW);

function drawspot($lat, $long, $strength, $age)
{
	global $image, $quake;	

	$width = imagesx($image);
	$height = imagesy($image);
	
	$minsize = $height / 360;
	$maxsize = $height / 30;
	
	$xp = $width/2 + $width*$long/360.0;
	$yp = $height/2 - $height*$lat/180.0;
	
	$size = $minsize + ($maxsize - $minsize) * $strength;

	$tmp = imagecreatetruecolor($size, $size);
	imagefill($tmp, 0, 0, 0x7f000000);

	imagecopyresampled($tmp, $quake, 0, 0, 0, 0, $size, $size, imagesx($quake), imagesy($quake));
	imagecopy($image, $tmp, $xp, $yp, 0, 0, $size, $size);

	if ($xp + $size >= $width) {
		imagecopy($image, $tmp, $xp - $width, $yp, 0, 0, $size, $size);
	}
	if ($xp - $size < 0) {
		imagecopy($image, $tmp, $xp + $width, $yp, 0, 0, $size, $size);
	}
}

$data = file_get_contents(URL);
$lines = explode("\n", $data);

for ($i=count($lines)-1; $i>0; $i--) {
	$values = str_getcsv($lines[$i]);
	if (count($values) < 6) continue;
	$time = $values[0];
	$lat = $values[1];
	$long = $values[2];
	$depth = $values[3];
	$mag = $values[4];
	$magtype = $values[5];

	drawspot($lat, $long, $mag / 9.0, $i/count($lines));
}

imagejpeg($image, dirname(__FILE__)."/earthmap_texture.jpg", 75);
