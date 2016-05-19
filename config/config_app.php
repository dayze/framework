<?php

//CONSTANT PATH
DEFINE("ENTITY_PATH", "models/Entity");
DEFINE("VENDOR", "vendor/");
DEFINE("MODELS", "models/");
DEFINE("USER_SESSION","user_session");
DEFINE("USER", "user");
DEFINE("ADMIN", "admin");

//Require config files
require('Autoloader.php');
require(VENDOR . "autoload.php");
require("config_database.php");
require("config_twig.php");

//Launch of Autoloader
new Autoloader();
