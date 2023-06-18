<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = file_get_contents('php://input');
    $response = json_decode($data, true);

    $username = $response["username"];
    $password = $response["password"];
    $res = [];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $res = [
            "status"  => 1,
            "message" => "iya deh"
        ];
    } else {
        // echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
        $res = [
            "status"  => 0,
            "message" => "Username or Password is wrong. Please try again!"
        ];
    }

    echo json_encode($res);
}