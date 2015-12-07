<?php
require_once APP_PATH . '/controller.php';

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
}
