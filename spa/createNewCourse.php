<?php
//сюда приходит джсон с данными
header('Access-Control-Allow-Origin: *');
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
http_response_code(200);

echo http_response_code(200);