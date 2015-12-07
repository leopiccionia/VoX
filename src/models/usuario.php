<?php

require_once APP_PATH . 'controller.php';

class Usuario extends Controller{

	private $id;
	private $nome;
    private $email;
    private $senha;
    private $senha_repetida;

    public function __construct($nome, $email, $senha, $senha_repetida){
		parent::__construct();
		$this->nome = $nome;
		$this->email = $email;
		$this->senha = $senha;
		$this->senha_repetida = $senha_repetida;
	}

	public function get_nome(){
		return $this->nome;
	}

	public function get_email(){
		return $this->email;
	}

	public function get_senha(){
		return $this->senha;
	}

	public function get_id(){
		return $this->id;
	}

	public function get_senha_repetida(){
		return $this->senha_repetida;
	}

    public function cadastrar(){
        $hash_senha = sha1($this->senha . strtolower($this->nome));

		try{
			$sucesso_cadastro = mysqli_query($this->abrir_conexao(), "INSERT INTO usuario(nome, email, senha, status) VALUES('{$this->nome}', '{$this->email}', '$hash_senha', 'C')");

			if($sucesso_cadastro)
				return $this->definir_id_usuario();

			return $sucesso_cadastro;
		}
		catch(Exception $e){
			return false;
		}
    }

	private function definir_id_usuario(){
		$conexao = $this->abrir_conexao();
		$query = mysqli_query($conexao, "SELECT usuario_id FROM usuario WHERE nome ='{$this->nome}' AND email = '{$this->email}'");
		mysqli_close($conexao);

		if($row = mysqli_fetch_array($query))
		{
			$this->id = $row['usuario_id'];
			return true;
		}
		return false;
	}

	public static function nomeDoId($id){
		
        $db_file = file_get_contents(APP_PATH . 'assets/private.json');
        $db_json = json_decode($db_file, true);

        $db_servidor = $db_json[ENV]['database']['server'];
        $db_usuario = $db_json[ENV]['database']['username'];
        $db_senha = $db_json[ENV]['database']['password'];
        $db_nome = $db_json[ENV]['database']['name'];

        $conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha, $db_nome);
		$query = mysqli_query($conexao, "SELECT nome FROM usuario WHERE usuario_id = {$id}");
		mysqli_close($conexao);
		
		if($row = mysqli_fetch_array($query))
		{
			$nome = $row['nome'];
			return $nome;	
		}
		return null;
	}   
}

