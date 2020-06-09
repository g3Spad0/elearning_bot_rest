<?php
$servername = "localhost";
$username = "root";
$password = "QWErty123456;";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "select * from slackbot.tests_questions where category_id=" . $_POST['category_id'];
$result = $conn->query($sql);

$arr = [];

while($row = $result->fetch_assoc()) {

    $id = $row['quest_id'];
    $quest = json_decode(file_get_contents("/home/max/ftp/elearning_bot/files/test/questions/2/$id.json"));
    $quest->id = $id;
    array_push($arr, $quest);
}

header('Access-Control-Allow-Origin: http://localhost:3000');

echo(json_encode($arr));

?>