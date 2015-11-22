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

	public function validar_informacoes(){
    	array_push($this->erros_validacao, $this->validar_nome());
    	array_push($this->erros_validacao, $this->validar_email());
        array_push($this->erros_validacao, $this->validar_senha());
        
        return array_filter($this->erros_validacao);
    }

    public function cadastrar(){
        $hash_senha = sha1($this->senha .$this->nome);

		try{
			$conexao = $this->abrir_conexao();
			return mysqli_query($conexao, "INSERT INTO usuario(nome, email, senha, status) VALUES('{$this->nome}', '{$this->email}', '$hash_senha', 'C')");
		}
		catch(Exception $e){
			return false;
		}
    }

    private function validar_nome(){
        if(empty($this->nome))
    	    return 'Favor, insira um nome de usuário.';

    	if(!preg_match("/^([a-zA-Z]+[ -']?)+$/", $this->nome))
    		return 'Favor, insira um texto válido como nome de usuário.';
    }

    private function validar_email(){
        if(empty($this->email))
        	return 'Favor, insira um e-mail.';
            

    	if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
    		return 'E-mail inserido está em um formato inválido. Favor, tentar novamente.';
    		
    	
    	if($this->email_nao_pertence_ao_dominio())
    		return 'O e-mail fornecido não pertence ao domínio "' .$allow_domain .'", favor insira um e-mail dentro do domínio.';

    	return $this->validar_email_ja_cadastrado();
    }

    private function email_nao_pertence_ao_dominio(){
    	$config_file = file_get_contents("assets/public.json");
		$config_json = json_decode($config_file, true);
		$allow_domain = $config_json['config']['allow_domain'];
    		
		return (!empty($allow_domain) && $allow_domain != explode('@', $this->email)[1]);
    }

     private function validar_email_ja_cadastrado(){
    	$conexao = $this->abrir_conexao();
    	$query = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='{$this->email}'");
    	
    	if($query->num_rows > 0)
    		return 'O e-mail informado já foi cadastrado anteriormente!';	
    }

     private function validar_senha(){
        if(empty($this->senha) || empty($this->senha2))
    		return 'Favor, insira a senha e a repita nos campos indicados.';

    	if($this->senha != $this->senha2)
    		return 'Favor, inserir a mesma senha nos dois campos indicados.';

    	if(strlen($this->senha) < 3 || !preg_match("#[0-9]+#", $this->senha) || !preg_match("#[a-zA-Z]+#", $this->senha))
    		return 'Sua senha deve ter mais que 3 caracteres, com pelo menos um sendo numérico e um sendo de alfabético.';
    }

     public function login($credencial, $senha){
        $this->id = -1;
		if(filter_var($credencial, FILTER_VALIDATE_EMAIL))
			return $this->loginPorEmail($credencial, $senha);
		else
			return $this->loginPorNome($credencial, $senha);
    }

    public function loginPorEmail($email, $senha){
		
		$this->definirHashSenhaPartindoDoEmailESenha($email, $senha);

		$conexao = $this->abrir_conexao();
		$query = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '{$email}' AND senha = '{$this->hash_senha}'");

		if($row = mysqli_fetch_array($query)){
			echo 'Entrou no if em que insere o Id da row';
			$this->id = $row['usuario_id'];
		}
		
		mysqli_close($conexao);

		if($this->id == -1)
			return false;

		return true;
	}

	private function definirHashSenhaPartindoDoEmailESenha($email, $senha){
		$conexao = $this->abrir_conexao();
		$query = mysqli_query($conexao, "SELECT nome FROM usuario WHERE email = '{$email}' AND status = 'C'");

		while($row = mysqli_fetch_array($query))
		{
			$this->nome = $row['nome'];
			$this->hash_senha = sha1($senha . $this->nome);
		}

		mysqli_close($conexao);
	}






	public function loginPorNome($nome, $senha){
		$conexao = $this->abrir_conexao();
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
		$conexao = $this->abrir_conexao();
		return mysqli_query($conexao, "INSERT INTO abstencao(usuario_id, pauta_id, data) VALUES({$this->id}, $pauta, NOW())");
	}

	private function votarOpcao($opcao){
		$conexao = $this->abrir_conexao();
		return mysqli_query($conexao, "INSERT INTO voto(usuario_id, opcao_id, data) VALUES({$this->id}, $opcao, NOW())");
	}

	private function abrir_conexao(){
		return mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
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
