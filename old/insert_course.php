<?php

$arr = [
    'coursename' => 'Long 248 days course New',
    'types' => [
        [
            'name' => 'Обучаемый',
            'days' => [
                ['number' =>1],
                ['number' =>2],
                ['number' =>3],
                ['number' =>4],
                ['number' =>5],
                ['number' =>6],
                ['number' =>7]
            ]
        ]
    ]
];
echo "<pre>";
echo 1;
if (!empty($_GET['a'])) {
    print_r($arr);die;
}

$json = json_encode($arr);

$ch = curl_init();
curl_setopt ($ch , CURLOPT_HTTPHEADER , array('Content-Type: application/json' ));
curl_setopt($ch, CURLOPT_URL,"http://83.220.170.194:8080/course/insert/new");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);

print_r($server_output);
?>