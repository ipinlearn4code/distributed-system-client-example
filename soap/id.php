<?php
include "client.php";
$uri = 'http://http://103.217.216.34:8000/';
$location = $uri . 'soap/server.php';
$cl = new Client($uri, $location);
var_dump($cl->tampil_data());