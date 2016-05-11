<?php
switch ($action) {
    case "logout":
        session_destroy();
        header('Location: index.php');
        break;

}
