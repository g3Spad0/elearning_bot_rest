<?php
//2 компания
//12 курс
//18 обучаемый
//19 наставник

//U010508S8CE илья воркспейс 1
//U011C7W58DD саша2 воркспейс 1
//UUERD5F25 саща1 ворк 1

$arr = [
    "course_id" => "1",
    "company_id" => "1",
    "user_type_id" => "2",
    "name" => "Илья",
    "email" => "sasha@2.ruaa",
    "slack_id" => "U010508S8CE",
    "start_date" => "2020-04-28 03:00:00",
    "gmt" => "+3",
    "week_day" => "0", //если есть, то он будет записываться сам
    "pattern" => "0",
    "use_weekends" => "true",
    "use_holidays" => "true"
];


//$arr = [
//    "course_id" => "12",
//    "company_id" => "2",
//    "user_type_id" => "18",
//    "name" => "Я второй с +6",
//    "email" => "sasha@2.ruaa",
//    "slack_id" => "U012GKT0BNV",
//    "start_date" => "2020-04-20 03:00:00",
//    "gmt" => "+6"
//];


//$arr = [
//    "course_id" => "12",
//    "company_id" => "2",
//    "user_type_id" => "18",
//    "name" => "Руслан",
//    "email" => "ruslan@ruslan.ruaa",
//    "slack_id" => "U011SHNSFBJ",
//    "start_date" => "2020-04-20 03:00:00",
//    "gmt" => "+3"
//];

//$arr = [
//    "course_id" => "12",
//    "company_id" => "2",
//    "user_type_id" => "18",
//    "name" => "Алина",
//    "email" => "alina@alina.ruaa",
//    "slack_id" => "U012TNPU7U0",
//    "start_date" => "2020-04-20 03:00:00",
//    "gmt" => "+3"
//];

//
//$arr = [
//    "course_id" => "12",
//    "company_id" => "2",
//    "user_type_id" => "18",
//    "name" => "Саша",
//    "email" => "sasha@a.ruaa",
//    "slack_id" => "U011HUQ844C",
//    "start_date" => "2020-04-20 03:00:00",
//    "gmt" => "+3"
//];
//
//
//$arr = [
//    "course_id" => "12",
//    "company_id" => "2",
//    "user_type_id" => "19",
//    "name" => "Илья",
//    "email" => "ilya@a.ruaa",
//    "slack_id" => "U011HUU5C4U",
//    "start_date" => "2020-04-20 03:00:00",
//    "gmt" => "+3"
//];
//
//$arr = [
//    "course_id" => "12",
//    "company_id" => "2",
//    "user_type_id" => "19",
//    "name" => "Даша",
//    "email" => "dasha@a.ruaa",
//    "slack_id" => "U011J0CGW9L",
//    "start_date" => "2020-04-20 03:00:00",
//    "gmt" => "+3"
//];


if (!empty($_GET['a'])) {
    print_r($arr);die;
}

echo "<pre>";

$json = json_encode($arr);

$ch = curl_init();
curl_setopt ($ch , CURLOPT_HTTPHEADER , array('Content-Type: application/json' ));
curl_setopt($ch, CURLOPT_URL,"http://83.220.170.194:8080/usersinsert");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);

print_r($server_output);