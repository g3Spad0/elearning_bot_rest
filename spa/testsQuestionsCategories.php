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

$sql = "select * from slackbot.tests_questions_categories";
$result = $conn->query($sql);

$arr = [];

while($row = $result->fetch_assoc()) {
    array_push($arr, $row);
}

header('Access-Control-Allow-Origin: http://localhost:3000');

echo json_encode($arr);

?>