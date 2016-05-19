<?php

//CONSTANT PATH
DEFINE("APP_PATH", "/var/www/html/framework/");
DEFINE("MODELS_PATH", APP_PATH . "models/");
DEFINE("ENTITY_PATH", MODELS_PATH . "Entity");
DEFINE("VENDOR_PATH", APP_PATH .  "vendor/");
DEFINE("CONTROLLER_PATH", APP_PATH . "controllers/");
DEFINE('PUBLIC_CONTROLLER_PATH', CONTROLLER_PATH . "publicController.php");
DEFINE('USER_CONTROLLER_PATH', CONTROLLER_PATH . "userController.php");
DEFINE('ADMIN_CONTROLLER_PATH', CONTROLLER_PATH . "adminController.php");

DEFINE("USER_SESSION","user_session");
DEFINE("USER", "user");
DEFINE("ADMIN", "admin");



//Require config files
require('Autoloader.php');
require(VENDOR_PATH . "autoload.php");
require("config_database.php");
require("config_twig.php");

//Launch of Autoloader
new Autoloader();
