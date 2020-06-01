<?php print "<pre>";
$host = 'localhost';
$dataBase_name   = 'slackbot';
$userDB = 'root';
$passDB = 'QWErty123456;';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$dataBase_name;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $userDB, $passDB, $opt);

} catch (PDOException $e) {
    exit ($e->getMessage());
}


$stmt = $pdo->prepare("SELECT * from days WHERE company_id=:id");
$stmt->execute([':id' => 1 ]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = gen();

foreach ($items as $item) {
    $hours = 12; $minutes = 10;

    for ($i = 0; $i < count($json); ++$i) {
        $arr = [];

        $arr['courseId'] = $item['course_id'];
        $arr['userTypeId'] = $item['users_type_id'];
        $arr['dayId'] = $item['days_id'];
        $arr['hours'] = $hours + $i;
        $arr['minutes'] = $minutes * $i;

        foreach ($json[$i]['message'] as $tmp) {
            $tmp = str_ireplace('REPLACE_ME', replaceR($item), $tmp);
            $tmp = json_decode($tmp, true);
            $arr['message'][] = $tmp;
        }
        $tmp = str_ireplace('REPLACE_ME', replaceR($item), $json[$i]['modal']);
        $arr['modal'] = json_decode($tmp);

        send($arr);
    }
}


function gen() {
    $arr = [];
    $i = 0;

    $arr[$i]['message'][0] = file_get_contents("json/chain1.json");
    $arr[$i]['message'][1] = file_get_contents("json/chain2.json");
    $arr[$i]['modal'] = file_get_contents("json/modal1.json");

    $i++;

    $arr[$i]['message'][0] = file_get_contents("json/simpleMsg.json");
    $arr[$i]['modal'] = "{}";

    $i++;

    $arr[$i]['message'][0] = file_get_contents("json/simpleMsgWithActionID_IN.json");
    $arr[$i]['modal'] = file_get_contents("json/modal2.json");

    return $arr;
}

function replaceR($item) {
    return $item['company_id'] . "/" . $item['course_id'] . "/" . $item['users_type_id'] . "/" . $item['days_id'] . " day number:" . $item['number'];
}

//echo "<pre>";
//
//$aaaa = '{"courseId":1,"companyId":1,"userTypeId": 1,"dayId":1,"hours":18,"minutes":12,"message": {
//    "blocks": [
//		{
//            "type": "section",
//			"text": {
//            "type": "mrkdwn",
//				"text": "This is a mrkdwn section block :ghost: *this is bold*, and ~this is crossed out~, and <https://google.com|this is a link>"
//			}
//		}
//	]
//}}';
//
//$arr = json_decode($aaaa, true);
//
//if (!empty($_GET['a'])) {
//    print_r($arr);
//}

function send($arr) {
    $json = json_encode($arr);

    $ch = curl_init();
    curl_setopt ($ch , CURLOPT_HTTPHEADER , array('Content-Type: application/json' ));
    curl_setopt($ch, CURLOPT_URL,"http://83.220.170.194:8080/course/insert/message");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close ($ch);

    print_r($server_output);
}
?>