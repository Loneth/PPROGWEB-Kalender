<?php

$DB_HOST = "127.0.0.1";
$DB_PORT = 3306;
$DB_DATABASE = "progwebdae";
$DB_USERNAME = "root";
$DB_PASSWORD = "test";

$conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE, $DB_PORT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$_SESSION["title"] = "dae";


function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}
