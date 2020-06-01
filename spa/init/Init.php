<?php

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
ini_set('default_charset', 'UTF-8');
error_reporting(0);

header('Access-Control-Allow-Origin: http://213.159.208.154:3000');
header('Access-Control-Allow-Credentials: true');
header('Content-type: application/json');

define("PATH", $_SERVER['DOCUMENT_ROOT'] . "/spa/");

require PATH . "db/DBConnection.php";

$pdo = DBConnection::connect();

session_start();

require PATH . "init/cookieHandler.php";
require PATH . "init/Configs.php";

$DATA = file_get_contents("php://input");

if (!empty($DATA)) $DATA = json_decode($DATA, true);