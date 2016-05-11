<?php

//Constante

//BDD
DEFINE('DB_NAME','');
DEFINE('DB_LOGIN','');
DEFINE('DB_PASSWORD','');
DEFINE('DB_HOST','localhost');
define("PDO_DSN","mysql:host=" . DB_HOST . ";dbname=" . DB_NAME);

//Chargement de l'autoloader
require 'autoloader.php';
Autoloader::register();