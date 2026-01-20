<?php

//phpinfo();


ini_set('display_errors', 1);

error_reporting(E_ALL);

require __DIR__ . '/../../vendor/autoload.php';

use Oleh\AmDev\core\Router;
use Oleh\AmDev\core\App;

require '../libs/functions.php';

session_start();

$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__ . '/src');
define('CORE', dirname(__DIR__) . '/core');
define('ROOT', dirname(__DIR__));
define('WWW1', dirname(__DIR__) . '/public/css/');
define('WWW2', ROOT . '/css/');

define('APP', dirname(__DIR__));

define('LAYOUT', 'default');

new App();
//$router = new Router();
//$router->run();
