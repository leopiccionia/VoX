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
		$this->credencial = $credencial;
		$this->senha = $senha;
		$this->usuario = new Usuario();
	}

	public function validar_dados_de_login(){
		if($this->valida_credencial())
			return 'A credencial informada não pôde ser encontrada.';

        if($this->valida_senha())
        	return 'A senha informada não pôde ser encontrada.';

        if(!$this->email_e_senha_estao_cadastrados())
        	return 'Não existe um usuário salvo com estas especificações.';

        return $this->usuario;
	}

	private function email_e_senha_estao_cadastrados(){
		$conexao = $this->abrir_conexao();
    	$query = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='{$this->credencial}' AND senha='{$this->hash_senha}'");

    	if($query->num_rows > 0)
    	{
    		$this->usuario->id = $query['id'];
    		$this->usuario->nome = $query['nome'];
    		$this->usuario->email = $query['email'];
    	}
    	return false;
	}

	private function valida_credencial(){
    	$conexao = $this->abrir_conexao();
    	$query = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='{$this->credencial}' OR nome='{$this->credencial}'");
    	
    	return $query->num_rows > 0;
	}

	private function valida_senha(){
		$this->hash_senha = $this->criar_hash_senha();
		return !is_string($this->hash_senha);
	}

	private function criar_hash_senha(){
		if($this->credencialEhEmail)
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

	private function criar_hash_senha_com_nome(){
		return sha1($this->senha . $row['nome']);
	}

}