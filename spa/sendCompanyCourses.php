<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";
includeAuth();

$offset = (int) $_GET['offset'];
$limit = (int) $_GET['limit'];

if ($offset <= 0) {
    $offset = 0;
}
if (!Configs::isCurrentLimit($limit)) {
    $limit = Configs::getDefaultLimit();
}

$stmt = $pdo->prepare("select course_id as courseId, created_admin, course.name as courseName, web_admins.id as admin_id, web_admins.name as admin_name, web_admins.email as admin_email
                        from course
                        inner join web_admins on course.created_admin = web_admins.id
                        where course.company_id=:company_id LIMIT " . $offset . "," . $limit);

$stmt->execute([ ':company_id' => $_SESSION['company_id'] ]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = [
    "total" => !empty($result) ? count($result) : 0,
    "coursesTileArr" => $result,
    "limit" => $limit,
    "offset" => $offset
];

print json_encode($data);