<?php

define('APP_PATH', __DIR__ . '/');
define('VIEW_PATH', APP_PATH . 'src/view/');
define('ASSETS_PATH', APP_PATH . 'assets/');
define('COMMOM_PATH', APP_PATH . 'commom/');
define('CONTROLLER_PATH', APP_PATH . 'src/controllers/');

define('ENV', (strpos($_SERVER['HTTP_HOST'], 'localhost') === false)? 'prod' : 'local');

switch ($_SERVER['REQUEST_URI']) {
    
    case '/login':
        require CONTROLLER_PATH . 'login.php';
        break;
    
    case '/home':
    	require VIEW_PATH . 'home.php';
    	break;


    default:
        require VIEW_PATH . "index.php";
        break;
}