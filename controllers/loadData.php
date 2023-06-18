<?php

header('Content-Type: application/json');

$sql = "SELECT * FROM `users_notes` WHERE `user_id` = '" . $_SESSION['id'] . "' ";
$result = mysqli_query($conn, $sql);
$res = [];

if ($result->num_rows > 0) {
    // $row = mysqli_fetch_assoc($result);
    // $res = [
    //     "title" => $row['title'],
    //     "lokasi" => $row['lokasi'],
    //     "timeStart" => $row['timeStart'],
    //     "timeEnd" => $row['timeEnd'],
    //     "level" => $row['level'],
    // ];

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
