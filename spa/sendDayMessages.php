<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";
includeAuth();

$offset = (int) $_GET['offset'];
$limit = (int) $_GET['limit'];
$dayId = (int) $_GET['dayId'];

if ($offset <= 0) {
    $offset = 0;
}
if (!Configs::isCurrentLimit($limit)) {
    $limit = Configs::getDefaultLimit();
}
if ($dayId <= 0) {
    $dayId = 0;
}

// переписать порядок
$types = [
    'message',
    'chain',
    'welcome',
    'finish'
];

$stmt = $pdo->prepare("select * from messages where day_id=:day_id and company_id=:company_id LIMIT " . $offset . "," . $limit);

$stmt->execute([ 'day_id' => $dayId, ':company_id' => $_SESSION['company_id'] ]);
$sqlRes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$result = [];

for ($i = 0; !empty($sqlRes) && $i < count($sqlRes); ++$i) {
    $result[$i] = [
        'messageSendTime' => $sqlRes[$i]['hours'] . ":" . ($sqlRes[$i]['minutes'] < 10 ? '0' . $sqlRes[$i]['minutes'] : $sqlRes[$i]['minutes']),
        'messageId' => $sqlRes[$i]['message_id'],
        'messageCount' => $sqlRes[$i]['count'],
        'messageType' => $types[$sqlRes[$i]['type']]
    ];
}

$data = [
    "total" => !empty($result) ? count($result) : 0,
    "messagesArr" => $result,
    "limit" => $limit,
    "offset" => $offset
];

print json_encode($data);