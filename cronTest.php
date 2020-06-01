<?php

$name = $_GET['test'];
date_default_timezone_set('Europe/Moscow');
$date = date('m.d.Y h:i:s', time());


file_put_contents("crontest.log", $name . " --- " . $date . "\n\n", FILE_APPEND);