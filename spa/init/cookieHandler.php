<?php

if (empty($_SESSION) && empty($_SESSION['auth']) && !empty($_COOKIE) && !empty($_COOKIE['key']) && !empty((int) $_COOKIE['id'])) {

    $stmt_COOKIE = $pdo->prepare("SELECT * FROM web_admins WHERE id=:id");
    $stmt_COOKIE->execute([':id' => (int) $_COOKIE['id'] ]);
    $item_COOKIE = $stmt_COOKIE->fetch();
    if (!empty($item_COOKIE) && $_COOKIE['key'] == $item_COOKIE['cookie']) {
        installCookie($item_COOKIE['id'], $item_COOKIE['company_id']);
    } else {
        cleanAuthCookie();
    }
}

function installCookie(int $id, int $company_id) {
    global $pdo;
    $key = generateRandomCookie(99);

    $_SESSION['auth'] = true;
    $_SESSION['id'] = $id;
    $_SESSION['company_id'] = $company_id;

    setcookie('id', $id, time()+60*60*24*30,"/");
    setcookie('key', $key, time()+60*60*24*30,"/");

    $stmt = $pdo->prepare("UPDATE web_admins SET cookie=:cookie WHERE id=:id");
    $stmt->execute([ ':cookie' => $key, ':id' => $id ]);
}

function generateRandomCookie(int $length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function cleanAuthCookie() {
    $_SESSION = [];

    setcookie('id', '', time() - 360000, '/');
    setcookie('key', '', time() - 360000, '/');
    session_destroy();
}

function includeAuth() {
    if (empty($_SESSION) || empty($_SESSION['auth'])) {
        http_response_code( 401);
        die;
    }
}