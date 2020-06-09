<?php

header('Access-Control-Allow-Origin: http://localhost:3000');

$servername = "localhost";
$username = "root";
$password = "QWErty123456;";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare('INSERT INTO slackbot.tests (test_name, company_id) VALUES (?,?)');
$stmt->bind_param('ss', $_POST['test_name'], $_POST['company_id']);
$stmt->execute();

$stmt = $conn->prepare('INSERT INTO slackbot.tests_questions_mapping (test_id, question_id) VALUES (?,?)');

$questions = explode(',', $_POST['questions']);

$testID = $conn->insert_id;
echo('test_id: '.$testID.' ');
for ($i = 0; $i < count($questions); $i++) {
  $stmt->bind_param('ss', $testID, $questions[$i]);
  $stmt->execute();
  echo($conn->error);
}

echo('success');

?>