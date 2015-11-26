<?php
class Controller{
    
    protected $db_servidor;
    protected $db_usuario;
    protected $db_senha;
    protected $db_nome;
    
    public function __construct(){
        $db_file = file_get_contents(APP_PATH . 'assets/private.json');
	    $db_json = json_decode($db_file, true);

	    $this->db_servidor = $db_json[ENV]['database']['server'];
	    $this->db_usuario = $db_json[ENV]['database']['username'];
	    $this->db_senha = $db_json[ENV]['database']['password'];
        $this->db_nome = $db_json[ENV]['database']['name'];
    }

    protected function abrir_conexao(){
        return mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
    }
}