<?php

error_reporting(E_ALL);

ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set('error_log', 'php-error.log');
error_log("Hello, errors!");

require_once 'vendor/autoload.php';
require_once 'src/routes/api.php';