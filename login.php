<!DOCTYPE html>
<html>
    <head>
        <title>VoX</title>
        <?php require 'assets/header.php' ?>
    </head>
    <body>
        <?php
            require 'helpers/persistencia.php';
            $credencial = $_POST['login_credencial'];
            $senha = $_POST['login_senha'];
            $erro_login = false;
            
            try{
                $conexao = mysql_connect($db_servidor, $db_usuario, $db_senha);
                $hash_senha;
                
                if(filter_var($credencial, FILTER_VALIDATE_EMAIL)){
                    /* Login via e-mail */
                    $query = mysql_query('SELECT nome FROM usuario WHERE email = "' . $credencial .'"');
                    $nome; $id;
                    while($row = mysql_fetch_array($query)){
                        $nome = $row['nome'];
                        $hash_senha = sha1($senha .$nome);
                    }
                    $query = mysql_query('SELECT * FROM usuario WHERE email = "' .$email .'" AND senha = "' .$senha .'"');
                    if($row = mysql_fetch_array($query)){
                        session_start();
                        $_SESSION['logado'] = true;
                        $_SESSION['id'] = $row['usuario_id'];
                    }
                    else{
                        $erro_login = true;
                    }
                }
                
                else{
                    /* Login via nome de usuario */
                    $hash_senha = sha1($senha .$credencial) ;
                    $query = mysql_query('SELECT * FROM usuario WHERE nome = "' . $credencial . '" AND senha = "' .$senha .'"');
                    if($row = mysql_fetch_array($query)){
                        session_start();
                        $_SESSION['logado'] = true;
                        $_SESSION['id'] = $row['usuario_id'];
                    }
                    else{
                        $erro_login = true;
                    }
                }
            }
            catch(Exception $erro){
                echo '<div class="alert alert-danger">Erro: ' . $erro->getMessage() .'.</div>';
                $erro_login = true;
                
            }
            finally{
                $conexao->mysql_close();
                if($erro_login){
                    echo '<div class="container main-container">'
                    .'<h1>Erro de login</h1>'
                    .'<p>Não foi possível completar o login no sistema. Para tentar novamente, retorne à <a href="index.php">página anterior</a>.</p>'
                    .'</div>';
                }
                else{
                    header('Location: home.php');
                    die();
                }
            }
        ?>  
    </body>
</html>
