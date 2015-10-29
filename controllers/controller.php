<?php
class Controller{
    private function db_servidor(){
        $db_file = file_get_contents("helpers/private.json");
	    $db_json = json_decode($db_file, true);
	    return $db_json['database']['server'];
    }
    
    private function db_servidor(){
        $db_file = file_get_contents("helpers/private.json");
	    $db_json = json_decode($db_file, true);
	    return $db_json['database']['username'];
    }
    
    private function db_senha(){
        $db_file = file_get_contents("helpers/private.json");
	    $db_json = json_decode($db_file, true);
	    return $db_json['database']['password'];
    }
}
?>