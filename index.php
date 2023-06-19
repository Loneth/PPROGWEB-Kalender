<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/config.php';

$dirView = __DIR__ . "/views/";
$dirController = __DIR__ . "/controllers/";

$url = explode('/', strtolower(substr($_SERVER['REQUEST_URI'], 1)));
$arg = $_SERVER['REQUEST_URI'];

switch ($url[0]) {
    case "login":
        require $dirView . 'login.php';
        break;
    case "signup":
        require $dirView . 'signup.php';
        break;
    case "logout":
        require $dirView . 'logout.php';
        break;
    case "edit":
        require $dirView . 'edit-kegiatan.php';
        break;
    case "delete":
        require $dirView . 'delete-kegiatan.php';
        break;

    /**
     * API Routes.
     */
    case "api":
        switch ($url[1]) {
            case "login":
                require $dirController . 'login-process.php';
                break;
            case "signup":
                require $dirController . 'signup-process.php';
                break;
            case "load-data":
                require $dirController . 'loadData.php';
                break;
            case "add-kegiatan":
                require $dirController . 'kegiatan.php';
                break;
            case "edit-kegiatan":
                require $dirController . 'edit-process.php';
                break;
            case "":
            case "/":
            default:
                print_r($url);
        }
        break;

    /**
     * Default Routes.
     */
    case "":
    case "/":
        require $dirView . 'home.php';
        break;
    default:
        echo "default";
};