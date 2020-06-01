<?php
//Эта старинчка обновляет данные о роли (название роли, даёт возможность добавить новый день в роль)
//сюда приходит джсон с данными
//вот такой:
$json = [
    "courseId" => 4, //ид курса
    "roleName" => "roleName", //название роли (может быть обновленным по сравнению с базой)
    "roleId"=> "roleId", //айди роли
    "days" => [
        [
            "dayNumber" => 1, //номер дня
            "dayId" => 5 //если день уже был в базе то будет id
        ]
    ],
    "deletedDays" => [ //будет длиной 0, если нет удалённых дней
        [
            "dayNumber" => 1, //номер дня
            "dayId" => 5 //если день уже был в базе то будет id
        ]
    ],
    "newDays" => [ //будет длиной 0, если нет удалённых дней
        [
            "dayNumber" => 1, //номер дня
        ]
    ]

];

header('Access-Control-Allow-Origin: *');
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
http_response_code(200);
echo http_response_code(200);