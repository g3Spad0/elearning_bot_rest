<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";
includeAuth();

$courseId = (int) $_GET['courseId'];

if ($courseId <= 0) {
    $courseId = 0;
}

$stmt = $pdo->prepare("select count(user_type_id) from users_type where course_id=:course_id and company_id=:company_id");
$stmt->execute([ 'course_id' => $courseId, ':company_id' => $_SESSION['company_id'] ]);
$result = $stmt->fetch();

$data = [
    "total" => empty($result) ? 0 : $result['count(user_type_id)']
];

print json_encode($data);