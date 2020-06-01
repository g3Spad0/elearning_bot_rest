<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";

//print "<pre>"; print_r([$_SESSION, $_COOKIE]);

function false($reason) {
    $arr = [
        "status" => false,
        "reason" => $reason
    ];

    print json_encode($arr);
    die;
}

function authFormula($str, $salt) {
    return md5($str) . $salt;
}

$email = $DATA['email'];
$password = $DATA['password'];

// костыль - так быстрее тестировать
if (!empty($_GET['email']) && !empty($_GET['password'])) {
    $email = $_GET['email'];
    $password = $_GET['password'];
}

if (!empty($_SESSION['auth'])) {
    false("already signed");
}

if (empty($email) || empty($password)) {
    false("empty input");
}

$stmt = $pdo->prepare("SELECT id,email,`name`,main_admin,company_id,password,salt FROM web_admins WHERE email=:email");
$stmt->execute([':email' => $email ]);
$user = $stmt->fetch();

if (empty($user)) {
    false("не найдено");
}

if (authFormula($password, $user['salt']) != $user['password']) {
    false("неверный пароль");
}

unset($user['password']);
unset($user['salt']);

installCookie($user['id'], $user['company_id']);

$arr = [
    "status" => true,
    "user" => $user
];

print json_encode($arr);