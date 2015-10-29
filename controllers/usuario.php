<?php
require_once 'controller.php';

class Usuario extends Controller{

    public $id;
    public $nome;
    public $email;
    private $hash_senha;
    
    private $senha;
    private $senha2;

    /* Retorna lista de erros */
    function valida(){
    	$mensagens_erro = array();
    	array_push($mensagens_erro, valida_nome());
    	array_push($mensagens_erro, valida_email());
        array_push($mensagens_erro, valida_senha());
        return $mensagens_erro;
    }
    
    private function valida_nome(){
        $mensagem_erro = array();
        if(empty($nome))
    	    array_push($mensagem_erro, 'Nome de usuário em branco.');
    	return $mensagem_erro;
    }
    
    private function valida_email(){
        $mensagem_erro = array();
        if(empty($email))
            array_push($mensagem_erro, 'E-mail em branco.');
    	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    		array_push($mensagem_erro, 'E-mail inválido.');
    	else{
    		$config_file = file_get_contents("../assets/public.json");
    		$config_json = json_decode($config_file, true);
    		$allow_domain = $config_json['config']['allow_domain'];
    		if(!empty($allow_domain) && $allow_domain != explode('@', $email)[1])
    			array_push($mensagem_erro, 'E-mail não pertence ao domínio "' .$allow_domain .'".');
    	}
    	return $mensagens_erro;
    }
    
    private function valida_senha(){
        $mensagens_erro = array();
        if(empty($senha) || empty($senha2))
    		array_push($mensagens_erro, 'Senha deve ser repetida.');
    	else if($senha != $senha2)
    		array_push($mensagens_erro, 'Senhas não batem.');
    	return $mensagens_erro;
    }
    
    private function cadastra(){
        require_once 'helpers/persistencia.php';
        $hash_senha = sha1($senha .$nome);
		try{
			$conexao = mysqli_connect(db_servidor(), db_usuario(), db_senha());
			return mysqli_query($conexao, "INSERT INTO usuario(nome, usuario, email, status) VALUES('$nome', '$email', '$hash_senha', 'C'");
		}
		catch(Exception $e){
			return false;
		}
    }
}
?>