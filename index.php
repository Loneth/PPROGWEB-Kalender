<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../config.php';

$request = $_SERVER['REQUEST_URI'];
$dirView = __DIR__ . "/views/";
$dirController = __DIR__ . "/controllers/";

switch ($request) {
    case "/login":
        require $dirView . 'login.php';
        break;
    case "/signup":
        require $dirView . 'signup.php';
        break;
    case "/logout":
        require $dirView . 'logout.php';
        break;

    /**
     * API Routes.
     */
    case "/api/login":
        require $dirController . 'login-process.php';
        break;
    case "/api/signup":
        require $dirController . 'signup-process.php';
        break;
    case "/api/loadData":
        require $dirController . 'loadData.php';
        break;
    case "/api/kegiatan":
        require $dirController . 'kegiatan.php';
        break;

    /**
     * Default Routes.
     */
    case "":
    case "/":
        require $dirView . 'home.php';
        break;
    default:
        // echo $request;
        echo "default";
};