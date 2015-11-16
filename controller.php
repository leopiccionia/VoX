<?php
class Controller{
    
    protected $db_servidor;
    protected $db_usuario;
    protected $db_senha;
    protected $db_nome;
    
    public function __construct(){
        $db_file = file_get_contents('assets/private.json');
	    $db_json = json_decode($db_file, true);

	    $this->db_servidor = $db_json['database']['server'];
	    $this->db_usuario = $db_json['database']['username'];
	    $this->db_senha = $db_json['database']['password'];
        $this->db_nome = $db_json['database']['name'];
    }
}
?>