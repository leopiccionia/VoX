<?php
require_once 'controller.php';

class Usuario extends Controller {

    public $id;
    public $nome;
    public $email;
    private $hash_senha;
    
    public $senha;
    public $senha2;

    public $erros_validacao;

	public function __construct(){
		parent::__construct();
		$this->erros_validacao = array();
	}

    /* Retorna lista de erros */
    function validar_informacoes(){
    	array_push($this->erros_validacao, $this->valida_nome());
    	array_push($this->erros_validacao, $this->valida_email());
        array_push($this->erros_validacao, $this->valida_senha());
        
        return array_filter($this->erros_validacao);
    }
    
    private function valida_nome(){
        if(empty($this->nome))
    	    return 'Favor, insira um nome de usuário.';
    }
    
    private function valida_email(){
        if(empty($this->email))
            return 'Favor, insira um e-mail.';

    	elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
    		return 'E-mail inserido está em um formato inválido. Favor, tentar novamente.';
    	
    	else{
    		return $this->verificar_email_pertence_ao_dominio();
    	}
    }

    private function verificar_email_pertence_ao_dominio(){
    	$config_file = file_get_contents("assets/public.json");
		$config_json = json_decode($config_file, true);
		$allow_domain = $config_json['config']['allow_domain'];
    		
		if(!empty($allow_domain) && $allow_domain != explode('@', $this->email)[1])
			return 'O e-mail fornecido não pertence ao domínio "' .$allow_domain .'", favor insira um e-mail dentro do domínio.';
    }
    
    private function valida_senha(){
        if(empty($this->senha) || empty($this->senha2))
    		return 'Favor, insira a senha e a repita nos campos indicados.';

    	if($this->senha != $this->senha2)
    		return 'Favor, inserir a mesma senha nos dois campos indicados.';
    }
    
    function cadastrar(){
        $hash_senha = sha1($this->senha .$this->nome);

		try{
			$conexao = mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
			return mysqli_query($conexao, "INSERT INTO usuario(nome, email, senha, status) VALUES('{$this->nome}', '{$this->email}', '$hash_senha', 'C')");
		}
		catch(Exception $e){
			return false;
		}
    }
    
    function login($credencial, $senha){
        $this->id = -1;
		if(filter_var($credencial, FILTER_VALIDATE_EMAIL))
			return loginPorEmail($credencial, $senha);
		else
			return loginPorNome($credencial, $senha);
    }
    
	function loginPorEmail($email, $senha){
		$conexao = mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
		$query = mysqli_query($conexao, "SELECT nome FROM usuario WHERE email = '{$this->email}' AND status = 'C'");

		while($row = mysqli_fetch_array($query)){
			$nome = $row['nome'];
			$this->hash_senha = sha1($this->senha .$this->nome);
		}
		
		$query = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '{$this->email}' AND senha = '{$this->hash_senha}'");
		if($row = mysqli_fetch_array($query))
			$this->id = $row['usuario_id'];
		
		mysqli_close($conexao);
		if($this->id == -1)
			return false;
		return true;
	}
	
	function loginPorNome($nome, $senha){
		$conexao = mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
		$this->hash_senha = sha1($senha .$nome);
		
		$query = mysqli_query($conexao, "SELECT * FROM usuario WHERE nome = '{$this->nome}' AND senha = '{$this->hash_senha}' AND status = 'C'");
		if($row = mysqli_fetch_array($query))
			$this->id = $row['usuario_id'];

		mysqli_close($conexao);
		if($this->id == -1)
			return false;
		return true;
	}

	public function vota($pauta, $opcao){
		if($opcao == 0)
			return absterVotacao($pauta);
		else
			return votarOpcao($opcao);
	}
	
	private function absterVotacao($pauta){
		$conexao = mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
		return mysqli_query($conexao, "INSERT INTO abstencao(usuario_id, pauta_id, data) VALUES({$this->id}, $pauta, NOW())");
	}
	
	private function votarOpcao($opcao){
		$conexao = mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
		return mysqli_query($conexao, "INSERT INTO voto(usuario_id, opcao_id, data) VALUES({$this->id}, $opcao, NOW())");
	}
	
	public static function nomeDoId($id){
		$conexao = mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
		$query = mysqli_connect($conexao, "SELECT nome FROM usuario WHERE usuario_id = {$this->id}");
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