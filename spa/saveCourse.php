<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";
includeAuth();
require_once PATH . "db/CourseSave.php";

function false($reason) {
    print json_encode([
        'status' => false,
        'reason' => $reason
    ]);
    die;
}

if (!empty($_GET['data'])) {
    $DATA = json_decode($_GET['data'], true);
}

if (empty($DATA)) {
    false("empty data");
}

$courseDB = new CourseSave($pdo);
$companyId = (int) $_SESSION['company_id'];
$courseId = 0;

$course = $DATA;

if ($courseDB->hasRepeats($course['roles'], "name")) {
    false("repeat in roles");
}

$courseId = $courseDB->saveCourse($companyId, $_SESSION['id'], $course['name'], true);

if ($courseId === 0) {
    false($courseDB->getError());
}
foreach ($course['roles'] as $role) {
    if ($courseDB->hasRepeats($role['days'], "number")) {
        false("repeat in days");
    }

    $roleId = $courseDB->saveRole($companyId, $courseId, $role['name'], (int) $role['reaction_count'], (int) $role['reaction_interval'], (int) $role['reaction_day_sum']);

    if ($roleId === 0) {
        false($courseDB->getError());
    }
    foreach ($role['days'] as $day) {
        $dayId = $courseDB->saveDay($companyId, $courseId, $roleId, $day['number']);

        if ($dayId === 0) {
            false($courseDB->getError());
        }
    }
}

$courseDB->ok();

print json_encode([
    "status" => true,
    "id" => $courseId
]);