<?php
    require_once MODEL_PATH . 'pauta.php';
    require_once VALIDATORS_PATH . 'pautaValidator.php';
    require_once USER_LOGGED;

    $pauta = new Pauta($_POST['titulo'], $_POST['descricao'], $_POST['data_inicio'], $_POST['data_fim']);
    $validator = new PautaValidator($pauta);

    $erros_validacao = $validator->validar_informacoes();
    
    if(empty($erros_validacao))
    {

        if($pauta->cadastrar())
        {
            $_SESSION['pauta'] = $pauta->buscar_mais_recente();
            header('Location: /opcao_pauta');
            die();
        }
        array_push($erros_validacao, 'Um erro interno impediu a criação da pauta.');
    }

    $_SESSION['erros_validacao'] = $erros_validacao;
    header('Location: /pauta');
    exit();
