<?php

//for ($i = 0; $i < 3; ++$i) {
//    $arr['coursename'] = 'курс №' . $i;
//    $types = [];
//
//    for ($j = 0; $j < 3; ++$j) {
//        $types[$j]['name'] = 'Обучаемый №' . $j;
//        $days = [];
//
//        for ($k = 1; $k <= 30; ++$k) {
//            $days[] = [ 'number' => $k ];
//        }
//        $types[$j]['days'] = $days;
//    }
//    $arr['types'] = $types;
//    send($arr);
//}

//$arr = [
//    'coursename' => 'Курс для теста из 35 дней',
//    'types' => [
//        [
//            'name' => 'Обучаемый',
//            'days' => [
//                ['number' =>1],
//                ['number' =>2],
//                ['number' =>3],
//                ['number' =>4],
//                ['number' =>5],
//                ['number' =>6],
//                ['number' =>7],
//                ['number' =>8],
//                ['number' =>9],
//                ['number' =>10],
//                ['number' =>11],
//                ['number' =>12],
//                ['number' =>13],
//                ['number' =>14],
//                ['number' =>15],
//                ['number' =>16],
//                ['number' =>17],
//                ['number' =>18],
//                ['number' =>19],
//                ['number' =>20],
//                ['number' =>21],
//                ['number' =>22],
//                ['number' =>23],
//                ['number' =>24],
//                ['number' =>25],
//                ['number' =>26],
//                ['number' =>27],
//                ['number' =>28],
//                ['number' =>29],
//                ['number' =>30],
//                ['number' =>31],
//                ['number' =>32],
//                ['number' =>33],
//                ['number' =>34],
//                ['number' =>35]
//            ]
//        ],
//        [
//            'name' => 'Наставник',
//            'days' => [
//                ['number' =>1],
//                ['number' =>2],
//                ['number' =>3],
//                ['number' =>4],
//                ['number' =>5],
//                ['number' =>6],
//                ['number' =>7],
//                ['number' =>8],
//                ['number' =>9],
//                ['number' =>10],
//                ['number' =>11],
//                ['number' =>12],
//                ['number' =>13],
//                ['number' =>14],
//                ['number' =>15],
//                ['number' =>16],
//                ['number' =>17],
//                ['number' =>18],
//                ['number' =>19],
//                ['number' =>20],
//                ['number' =>21],
//                ['number' =>22],
//                ['number' =>23],
//                ['number' =>24],
//                ['number' =>25],
//                ['number' =>26],
//                ['number' =>27],
//                ['number' =>28],
//                ['number' =>29],
//                ['number' =>30],
//                ['number' =>31],
//                ['number' =>32],
//                ['number' =>33],
//                ['number' =>34],
//                ['number' =>35]
//            ]
//        ]
//    ]
//];


$arr = [
    'coursename' => 'Курс для теста из 1 дня',
    'types' => [
        [
            'name' => 'Обучаемый с курса 1 день',
            'days' => [
                ['number' =>1]
            ]
        ],
        [
            'name' => 'Наставник с курса 1 день',
            'days' => [
                ['number' =>1]
            ]
        ]
    ]
];


send($arr);
die;
echo "<pre>";
echo 1;
if (!empty($_GET['a'])) {
    print_r($arr);die;
}die;

function send($arr) {
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
}