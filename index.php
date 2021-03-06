<?php
include_once('config/config_app.php');

$c = "";
$squelette = "views/public.php";
$controller = "controllers/publicController.php";
session_start();

try {
    $action = isset($_GET["a"]) ? $_GET["a"] : "home";
    if (isset($_SESSION[USER_SESSION])) {
        $squelette = "views/layout.php";
        $controller = "controllers/" . $_SESSION[USER_SESSION]->getStatus() . "Controller.php";
    }
    include($controller);
} catch (Exception $e) {
    var_dump($e->getMessage()); // Only debug
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    ob_clean();
    echo $c;
} else {
    ob_start();
    require_once($squelette);
    $html = ob_get_contents();
    ob_end_clean();
    echo $html;
}