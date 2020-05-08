<?php
use Illuminate\Session\Middleware\StartSession;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
header('Content-Type: audio');
$track_id=$_GET['id'];
$url = 'https://api.jsonbin.io/b/5eafd4ca47a2266b1472794c'; 
$data = file_get_contents($url); 
$playlist = json_decode($data, true); 
$id=1;
$tracks=[];
foreach ($playlist['tracks'] as $track) {
  $track['id']= $id;
  array_push($tracks,$track);
  $id++;
}
$download_link=$tracks[$track_id-1]['url'];
readfile($download_link); 

