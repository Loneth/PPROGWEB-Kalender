<?php

if (!isset($_SESSION['id'])) {
    header("Location: /login");
    exit();
}

header('Content-Type: application/json');

$sql = "SELECT * FROM `users_notes` WHERE `user_id` = '" . $_SESSION['id'] . "' ";
$result = mysqli_query($conn, $sql);
$res = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data = [
            "id" => $row['id'],
            "title" => $row['title'],
            "lokasi" => $row['lokasi'],
            "timeStart" => $row['timeStart'],
            "timeEnd" => $row['timeEnd'],
            "level" => $row['level'],
        ];
    
        array_push($res, $data);
    }
}

echo json_encode($res);
