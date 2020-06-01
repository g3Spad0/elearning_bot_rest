<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";
includeAuth();

$offset = (int) $_GET['offset'];
$limit = (int) $_GET['limit'];
$userRoleId = (int) $_GET['userRoleId'];

if ($offset <= 0) {
    $offset = 0;
}
if (!Configs::isCurrentLimit($limit)) {
    $limit = Configs::getDefaultLimit();
}
if ($userRoleId <= 0) {
    $userRoleId = 0;
}

$stmt = $pdo->prepare("select days_id as dayId, number as dayNumber from days where users_type_id=:users_type_id and company_id=:company_id LIMIT " . $offset . "," . $limit);

$stmt->execute([ 'users_type_id' => $userRoleId, ':company_id' => $_SESSION['company_id'] ]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = [
    "total" => !empty($result) ? count($result) : 0,
    "daysArr" => $result,
    "limit" => $limit,
    "offset" => $offset
];

print json_encode($data);