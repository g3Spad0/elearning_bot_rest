<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";
includeAuth();

$dayId = (int) $_GET['dayId'];

if ($dayId <= 0) {
    $dayId = 0;
}

$stmt = $pdo->prepare("select count(message_id) from messages where day_id=:day_id and company_id=:company_id");

$stmt->execute([ 'day_id' => $dayId, ':company_id' => $_SESSION['company_id'] ]);
$result = $stmt->fetch();

$data = [
    "total" => empty($result) ? 0 : $result['count(message_id)']
];

print json_encode($data);