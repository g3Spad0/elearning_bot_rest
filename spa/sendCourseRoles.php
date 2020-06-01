<?PHP

require_once $_SERVER['DOCUMENT_ROOT'] . "/spa/init/Init.php";
includeAuth();

$offset = (int) $_GET['offset'];
$limit = (int) $_GET['limit'];
$courseId = (int) $_GET['courseId'];

if ($offset <= 0) {
    $offset = 0;
}
if (!Configs::isCurrentLimit($limit)) {
    $limit = Configs::getDefaultLimit();
}
if ($courseId <= 0) {
    $courseId = 0;
}

$stmt = $pdo->prepare("select user_type_id as roleId, name as roleName, reaction_count, reaction_interval, reaction_day_sum, welcome_message, finish_message 
                                from users_type
                                where course_id=:course_id and company_id=:company_id LIMIT " . $offset . "," . $limit);

$stmt->execute([ 'course_id' => $courseId, ':company_id' => $_SESSION['company_id'] ]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = [
    "total" => !empty($result) ? count($result) : 0,
    "rolesArr" => $result,
    "limit" => $limit,
    "offset" => $offset
];

print json_encode($data);