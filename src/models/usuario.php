<?php

require_once APP_PATH . 'controller.php';

class Usuario extends Controller{

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

	public function get_senha_repetida(){
		return $this->senha_repetida;
	}

	public function get_id(){
		$conexao = abrir_conexao();
		$query = mysqli_query($conexao, "SELECT usuario_id FROM usuario WHERE email = '{$this->email}'");
		if($row = mysql_fetch_array($query))
			return $row['usuario_id'];
		return false;
	}

    public function cadastrar(){
        $hash_senha = sha1($this->senha . strtolower($this->nome));

		try{
			return mysqli_query($this->abrir_conexao(), "INSERT INTO usuario(nome, email, senha, status) VALUES('{$this->nome}', '{$this->email}', '$hash_senha', 'C')");
		}
		catch(Exception $e){
			return false;
		}
    }
}

