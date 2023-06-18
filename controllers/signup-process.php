<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json; charset=utf-8');

    $data = file_get_contents('php://input');
    $response = json_decode($data, true);

    $email = $response["email"];
    $username = $response["username"];
    $password = $response["password"];
    $password2 = $response["password2"];
    $res = [];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $res = [
            "status"  => 0,
            "message" => "Username not available"
        ];
    }

    if ($num == 0) {
        if ($password != $password2) {
            $res = [
                "status"  => 0,
                "message" => "Passwords do not match"
            ];
        } else {
            $sql = "INSERT INTO `users` (`username`, `password`, `email`) VALUES ('$username', '$password', '$email')";
            $result = mysqli_query($conn, $sql);
        
            $res = [
                "status"  => 1,
                "message" => "iya"
            ];
        }
    }

    echo json_encode($res);
}
