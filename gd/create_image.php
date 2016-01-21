<?php
//$img = imageCreateTrueColor(500,300);
$img = imagecreatefromjpeg("images/noise.jpg");
imageAntiAlias($img, true);//зглаживание

$red = imageColorAllocate($img,255,0,0);
$green = imageColorAllocate($img,0,255,0);
$blue = imageColorAllocate($img,0,0,255);
$white = imageColorAllocate($img,255,255,255);
$black = imageColorAllocate($img,0,0,0);
$silver = imageColorAllocate($img,192,192,192);
/*
imageLine($img,20,20,480,280,$white);
imageLine($img,480,20,20,280,$red);
imageFilledRectangle($img,40,40,80,280,$white);
imageRectangle($img,20,20,80,280,$blue);
$points = array(0,0,100,200,300,200);
imagePolygon($img, $points,3,$green);
imageEllipse($img, 200,150,300,200, $red);
imageFilledEllipse($img, 200,150,300,200, $red);
imageArc($img, 210,160,300,200,0,-60, $blue);
imageFilledArc($img, 210,160,300,200,0,90, $silver, IMG_ARC_NOFILL);
imageString($img, 5, 150, 200, "Hello!", $white);
imageTtfText($img,30,10,200,150,$red,"arial.ttf","Привет!");
*/
imageTtfText($img,20,3,20,30,$black,"arial.ttf","Привет");

header ('Content-type: image/png');
imagePNG($img);
?>