<?php

define('APP_PATH', __DIR__ . '/');
define('VIEW_PATH', APP_PATH . '/src/view/');

define('ENV', (strpos($_SERVER['HTTP_HOST'], 'localhost') === false)? 'prod' : 'local');

switch ($_SERVER['REQUEST_URI']) {
    case '/login':
        require 'src/controllers/login.php';
        break;
    
    default:
        require VIEW_PATH . "index.php";
        break;
}