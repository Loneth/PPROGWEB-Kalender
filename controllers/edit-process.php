<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json; charset=utf-8');

    $data = file_get_contents('php://input');
    $response = json_decode($data, true);

    $title = $_POST["title"];
    $lokasi = $_POST["lokasi"];
    $timeStart = $_POST["timeStart"];
    $timeEnd = $_POST["timeEnd"];
    $level = $_POST["level"];
    $id = $_POST["id"];
    $res = [];

    $sql = "SELECT * FROM users_notes WHERE title='$title' AND id='$id' ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $res = [
            "status"  => 0,
            "message" => "Kegiatan already exists"
        ];
    } else {
        $sql = "UPDATE users_notes SET `lokasi`='$lokasi', `timeStart`='$timeStart', `timeEnd`='$timeEnd', `level`='$level' WHERE `id`='$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $res = [
                "status"  => 1,
                "message" => "Kegiatan updated successfully"
            ];
        } else {
            $res = [
                "status"  => 0,
                "message" => "Failed to update kegiatan"
            ];
        }
    }

    echo json_encode($res);
}
