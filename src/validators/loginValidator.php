<?php

require_once APP_PATH . 'usuario.php';
require_once APP_PATH . 'controller.php';

class LoginValidator extends Controller{

	private $credencial;
	private $senha;
	private $hash_senha;
	private $usuario;

	public function __construct($credencial, $senha)
	{
		parent::__construct();
		$this->credencial = $credencial;
		$this->senha = $senha;
		$this->usuario = new Usuario();
	}

	public function validar_dados_de_login(){
		if(empty($this->credencial) || empty($this->senha))
			return 'Favor, insira uma credencial e uma senha para realizar o login';

		if(!$this->credencial_valida())
			return 'A credencial informada não pôde ser encontrada.';

        if(!$this->senha_valida())
        	return 'A senha não é válida para a credencial informada.';

        return $this->usuario;
	}
	

	private function credencial_valida(){
		$conexao = $this->abrir_conexao();
    	$query = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='{$this->credencial}' OR nome='{$this->credencial}'");

    	return $query->num_rows > 0;
	}

	private function senha_valida(){
		$hash_senha = $this->criar_hash_senha();
		
		if(is_string($hash_senha))
			return $this->email_senha_cadastrados($hash_senha);
		
		return false;
	}

	private function criar_hash_senha(){
		if($this->credencial_eh_email())
			return $this->criar_hash_senha_com_email();
		else
			return $this->criar_hash_senha_com_nome();
	}
	
	private function criar_hash_senha_com_email(){
		$conexao = $this->abrir_conexao();
		$query = mysqli_query($conexao, "SELECT nome FROM usuario WHERE email = '{$this->credencial}' AND status = 'C'");

		if($row = mysqli_fetch_array($query))
			$this->hash_senha = sha1($this->senha . $row['nome']);

		mysqli_close($conexao);
		return false;
	}

	private function email_senha_cadastrados($hash_senha){
		$conexao = $this->abrir_conexao();
		$query = $this->pesquisar_por_credencial_e_senha($conexao, $hash_senha);
		mysqli_close($conexao);

    	if($row = mysqli_fetch_array($query))
    	{
    		$this->usuario->id = $row['usuario_id'];
    		$this->usuario->nome = $row['nome'];
    		$this->usuario->email = $row['email'];

			return true;
    	}
    	return false;
	}

	private function criar_hash_senha_com_nome(){
		return sha1($this->senha . $this->credencial);
	}

	private function credencial_eh_email(){
		return filter_var($this->credencial, FILTER_VALIDATE_EMAIL);
	}

	private function pesquisar_por_credencial_e_senha($conexao, $hash_senha){
		if($this->credencial_eh_email())
	    	return mysqli_query($conexao, "SELECT * FROM usuario WHERE email='{$this->credencial}' AND senha='{$hash_senha}'");
	    else
	    	return mysqli_query($conexao, "SELECT * FROM usuario WHERE nome='{$this->credencial}' AND senha='{$hash_senha}'");
	}
}