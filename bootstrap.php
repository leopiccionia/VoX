<?php

define('APP_PATH', __DIR__ . '/');
define('VIEW_PATH', APP_PATH . 'src/view/');
define('ASSETS_PATH', APP_PATH . 'assets/');
define('COMMOM_PATH', APP_PATH . 'commom/');
define('CONTROLLER_PATH', APP_PATH . 'src/controllers/');
define('MODEL_PATH', APP_PATH . 'src/models/');
define('VALIDATORS_PATH', APP_PATH . 'src/validators/');

define('ENV', (strpos($_SERVER['HTTP_HOST'], 'localhost') === false)? 'prod' : 'local');

switch ($_SERVER['REQUEST_URI']) {

	case '/cadastro':
		require CONTROLLER_PATH . 'cadastro.php';
		break;
    
    case '/login':
        require CONTROLLER_PATH . 'login.php';
        break;
    
    case '/home':
    	require VIEW_PATH . 'home.php';
    	break;

    case '/pauta':
        require VIEW_PATH . 'pauta.php';
        break;

    case '/cadastrar_pauta':
        require CONTROLLER_PATH . 'pauta.php';
        break;

    default:
        require VIEW_PATH . "index.php";
        break;
}