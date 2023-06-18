<?php

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = file_get_contents('php://input');
    $response = json_decode($data, true);

    $title = $response["title"];
    $lokasi = $response["lokasi"];
    $timeStart = $response["timeStart"];
    $timeEnd = $response["timeEnd"];
    $level = $response["level"];
    $res = [];

    $sql = "INSERT INTO `users_notes` (`user_id`, `title`, `lokasi`, `timeStart`, `timeEnd`, `level`) VALUES ('".$_SESSION['id']."', '$title', '$lokasi', '$timeStart', '$timeEnd', '$level')";
    $result = mysqli_query($conn, $sql);
    $res = [
        "status"  => 1,
        "message" => "iya"
    ];

    echo json_encode($res);
}