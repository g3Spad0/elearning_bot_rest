<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";
includeAuth();

$stmt = $pdo->prepare("select count(course_id) from course where course.company_id=:company_id");
$stmt->execute([ ':company_id' => $_SESSION['company_id'] ]);
$result = $stmt->fetch();

$data = [
    "total" => empty($result) ? 0 : $result['count(course_id)']
];

print json_encode($data);