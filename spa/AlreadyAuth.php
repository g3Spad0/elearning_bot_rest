<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";

if (!empty($_SESSION['auth'])) {
    $stmt = $pdo->prepare("SELECT id,email,`name`,main_admin,company_id FROM web_admins WHERE id=:id");
    $stmt->execute([':id' => $_SESSION['id'] ]);
    $user = $stmt->fetch();

    print json_encode([
        "status" => true,
        "user" => $user
    ]);
}
else {
    print json_encode([
        "status" => false
    ]);
}