<?php
require("lib/Generation.php");
include("config/config_app.php");

if (isset($argv[1])) {
    new Generation($argv[1]);
} else {
    new Generation();
}
