<?php

ini_set('display_errors', 1);

require_once(__DIR__ . '/vendor/autoload.php');

// Twitter API Infomation
define('CONSUMER_KEY', 'xxxxxxxxxxxxxxxx');
define('CONSUMER_SECRET', 'xxxxxxxxxxxxxxxxxxxxxxx');
define('CALLBACK_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/login.php');

// Database Infomation
define('DSN', 'mysql:host=localhost;dbname=xxxxxxxx');
define('DB_USERNAME', 'xxxxxx');
define('DB_PASSWORD', 'xxxxxx');

session_start();

require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/autoload.php');



 ?>
