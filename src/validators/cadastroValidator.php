<?php

require_once MODEL_PATH . 'usuario.php';
require_once APP_PATH . 'controller.php';

class cadastroValidator extends Controller{

    private $erros_validacao;
    private $nome;
    private $email;
    private $senha;
    private $senha_repetida;

	public function __construct($usuario)
	{
		parent::__construct();
		$this->nome = $usuario->get_nome();
		$this->email = $usuario->get_email();
		$this->senha = $usuario->get_senha();
		$this->senha_repetida = $usuario->get_senha_repetida();
		$this->erros_validacao = array();
	}

	public function validar_informacoes(){
    	array_push($this->erros_validacao, $this->validar_nome());
    	array_push($this->erros_validacao, $this->validar_email());
        array_push($this->erros_validacao, $this->validar_senha());
        
        return array_filter($this->erros_validacao);
    }

	private function validar_nome(){
        if(empty($this->nome))
    	    return 'Favor, insira um nome de usuário.';

    	if(strlen($this->nome) <= 3)
    		return 'Favor, insira um nome com mais de três caracteres';

    	if(!preg_match("/^[a-zA-Z0-9\x20]{3,25}$/", $this->nome))
    		return 'Favor, insira um nome de usuário com até 25 caracteres alfabéticos.';
    }

    private function validar_email(){
        if(empty($this->email))
        	return 'Favor, insira um e-mail.';
            
    	if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
    		return 'E-mail inserido está em um formato inválido. Favor, tentar novamente.';
    		
    	if($this->email_nao_pertence_ao_dominio())
    		return 'O e-mail fornecido não pertence ao domínio "' .$allow_domain .'", favor insira um e-mail dentro do domínio.';

    	if($this->email_existe())
    		return 'O e-mail informado já foi cadastrado anteriormente!';
    }

    private function email_nao_pertence_ao_dominio(){
    	$config_file = file_get_contents("assets/public.json");
		$config_json = json_decode($config_file, true);
		$allow_domain = $config_json['config']['allow_domain'];
    		
		return (!empty($allow_domain) && $allow_domain != explode('@', $this->email)[1]);
    }

     private function email_existe(){
    	$conexao = $this->abrir_conexao();
    	$query = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='{$this->email}'");
    	
    	return $query->num_rows > 0;
    }

     private function validar_senha(){
        if(empty($this->senha) || empty($this->senha_repetida))
    		return 'Favor, insira a senha e a repita nos campos indicados.';

    	if($this->senha != $this->senha_repetida)
    		return 'Favor, inserir a mesma senha nos dois campos indicados.';

    	if(strlen($this->senha) < 3 || !preg_match("#[0-9]+#", $this->senha) || !preg_match("#[a-zA-Z]+#", $this->senha))
    		return 'Sua senha deve ter mais que 3 caracteres, sendo pelo menos um deles numérico e outro alfabético.';
    }
}

