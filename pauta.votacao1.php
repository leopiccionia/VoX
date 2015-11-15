<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: /index.php');
        die();
    }
    require_once 'usuario.php';
    $sucesso = $_SESSION['usuario']->vota($_POST['pauta'], $_POST['opcao']);
    if($sucesso){
        header('Location: /home.php');
        die();
    }
    else echo 'Não foi possível registrar voto. Tente novamente.';
?>