<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json; charset=utf-8');

    $data = file_get_contents('php://input');
    $response = json_decode($data, true);

    $title = $response["title"];
    $lokasi = $response["lokasi"];
    $timeStart = $response["timeStart"];
    $timeEnd = $response["timeEnd"];
    $level = $response["level"];
    $id = $response["id"];
    $res = [];

    $sql = "UPDATE users_notes SET `title`='$title', `lokasi`='$lokasi', `timeStart`='$timeStart', `timeEnd`='$timeEnd', `level`='$level' WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);
    $res = [
        "status"  => 1,
        "message" => "Kegiatan updated successfully"
    ];

    echo json_encode($res);
}
