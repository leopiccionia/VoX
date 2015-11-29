<?php
    require_once MODEL_PATH . 'pauta.php';

    session_start();
	
    if(!isset($_SESSION['usuario']))
    {
		header('Location: /index.php');
		die();
	}
    
    $pauta = new Pauta($_POST['titulo'], $_POST['descricao'], $_POST['data_inicio'], $_POST['data_fim']);
    $validator = new PautaValidator($pauta);

    $erro_validacao = $validator->validar_informacoes();
    $erro_cadastro = false;
    
    if(empty($erro_validacao))
    {
        if($pauta->cadastrar())
        {
            $_SESSION['pauta'] = $pauta->buscar_mais_recente();
            //header('Location: /opcao_pauta.cadastro.php');
            //die();
        }
        array_push($erros_validacao, 'Um erro interno impediu a criação da pauta.');
    }

    $_SESSION['erros_validacao'] = $erros_validacao;
    header('Location: /pauta');
    exit();
