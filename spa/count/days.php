<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";
includeAuth();

$userRoleId = (int) $_GET['userRoleId'];

if ($userRoleId <= 0) {
    $userRoleId = 0;
}

$stmt = $pdo->prepare("select count(days_id) from days where users_type_id=:users_type_id and company_id=:company_id");
$stmt->execute([ 'users_type_id' => $userRoleId, ':company_id' => $_SESSION['company_id'] ]);
$result = $stmt->fetch();

$data = [
    "total" => empty($result) ? 0 : $result['count(days_id)']
];

print json_encode($data);