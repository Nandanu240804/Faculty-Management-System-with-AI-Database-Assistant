<?php
header("Content-Type: application/json");
require_once 'db_connection.php'; // Ensure database connection

if (!isset($_GET['action'])) {
    echo json_encode(["error" => "No action specified"]);
    exit();
}

$action = $_GET['action'];

if ($action === "get_teacher_count") {
    $query = "SELECT COUNT(*) AS total FROM teachers";
    $result = $con->query($query);
    $row = $result->fetch_assoc();
    echo json_encode(["total_teachers" => $row['total']]);
}

elseif ($action === "get_teacher_info" && isset($_GET['name'])) {
    $name = $_GET['name'];
    $stmt = $con->prepare("SELECT * FROM teachers WHERE name LIKE ?");
    $like_name = "%$name%";
    $stmt->bind_param("s", $like_name);
    $stmt->execute();
    $result = $stmt->get_result();

    $teachers = [];
    while ($row = $result->fetch_assoc()) {
        $teachers[] = $row;
    }
    echo json_encode(["teachers" => $teachers]);
} 

else {
    echo json_encode(["error" => "Invalid action"]);
}

$con->close();
?>
