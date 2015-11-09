<?php
class Controller{
    
    private $db_servidor;
    private $db_usuario;
    private $db_senha;
    
    function __construct(){
        $db_file = file_get_contents('assets/private.json');
	    $db_json = json_decode($db_file, true);
	    $this->$db_servidor = $db_json['database']['server'];
	    $this->$db_usuario = $db_json['database']['username'];
	    $this->$db_senha = $db_json['database']['password'];
    }
}
?>