<?php
require_once 'controller.php';

class Usuario extends Controller{

    public $id;
    public $nome;
    public $email;
    private $hash_senha;
    
    private $senha;
    private $senha2;

	public function __construct(){
		parent::__construct();
	}

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
    	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
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
    	elseif($senha != $senha2)
    		array_push($mensagens_erro, 'Senhas não batem.');
    	return $mensagens_erro;
    }
    
    function cadastra(){
        $hash_senha = sha1($senha .$nome);
		try{
			$conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
			return mysqli_query($conexao, "INSERT INTO usuario(nome, usuario, email, status) VALUES('$nome', '$email', '$hash_senha', 'C'");
		}
		catch(Exception $e){
			return false;
		}
    }
    
    function login($credencial, $senha){
        $this->$id = -1;
		if(filter_var($credencial, FILTER_VALIDATE_EMAIL))
			return loginPorEmail($credencial, $senha);
		else
			return loginPorNome($credencial, $senha);
    }
    
	function loginPorEmail($email, $senha){
		$conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
		$query = mysqli_query($conexao, "SELECT nome FROM usuario WHERE email = '$email' AND status = 'C'");

		while($row = mysqli_fetch_array($query)){
			$nome = $row['nome'];
			$hash_senha = sha1($senha .$nome);
		}
		
		$query = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '$email' AND senha = '$hash_senha'");
		if($row = mysqli_fetch_array($query))
			$this->$id = $row['usuario_id'];
		
		mysqli_close($conexao);
		if($this->$id == -1)
			return false;
		return true;
	}
	
	function loginPorNome($nome, $senha){
		$conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
		$hash_senha = sha1($senha .$nome);
		
		$query = mysqli_query($conexao, "SELECT * FROM usuario WHERE nome = '" . $nome . "' AND senha = '" .$senha ."' AND status = 'C'");
		if($row = mysqli_fetch_array($query))
			$this->$id = $row['usuario_id'];

		mysqli_close($conexao);
		if($$this->id == -1)
			return false;
		return true;
	}
	
	static function nomeDoId($id){
		$conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
		$query = mysqli_connect($conexao, "SELECT nome FROM usuario WHERE usuario_id = $id");
		if($row = mysqli_fetch_array($query)){
			$nome = $row['nome'];
			mysqli_close($conexao);
			return $nome;	
		}
		mysqli_close($conexao);
		return null;
	}
        
}
?>