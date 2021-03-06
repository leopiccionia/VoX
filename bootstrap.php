<?php

define('APP_PATH', __DIR__ . '/');
define('VIEW_PATH', APP_PATH . 'src/view/');
define('ASSETS_PATH', APP_PATH . 'assets/');
define('COMMOM_PATH', APP_PATH . 'commom/');
define('CONTROLLER_PATH', APP_PATH . 'src/controllers/');
define('MODEL_PATH', APP_PATH . 'src/models/');
define('VALIDATORS_PATH', APP_PATH . 'src/validators/');
define('USER_LOGGED', COMMOM_PATH . 'user_logged_confirmation.php');
define('JS_PATH', ASSETS_PATH . 'js/');

define('ENV', (strpos($_SERVER['HTTP_HOST'], 'localhost') === false)? 'prod' : 'local');

switch ($_SERVER['REQUEST_URI']) {

	case '/cadastro':
		require CONTROLLER_PATH . 'cadastro.php';
		break;
    
    case '/login':
        require CONTROLLER_PATH . 'login.php';
        break;
    
    case '/logoff':
        require APP_PATH . 'logoff.php';
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

    case '/opcao_pauta':
        require VIEW_PATH . 'opcao_pauta.php';
        break;

    case '/cadastrar_opcao_pauta':
        require CONTROLLER_PATH .  'opcao_pauta.php';
        break;

    case '/pesquisar':
        require VIEW_PATH . 'pesquisa.php';
        break;

    case '/pesquisar_pauta':
        require CONTROLLER_PATH . 'pesquisa.php';
        break;

    case '/listagem_pautas': 
        require VIEW_PATH . 'listagem_pautas.php';
        break;

     default:
         require VIEW_PATH . "index.php";
         break;
}