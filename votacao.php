<!DOCTYPE html>
<html>
    <head>
        <title>
            
        </title>
    </head>
    <body>
        <?php
            $db_file = file_get_contents("private.json");
        	$db_json = json_decode($db_file, true);
        	
        	$db_servidor = $db_json['database']['server'];
        	$db_usuario = $db_json['database']['username'];
        	$db_senha = $db_json['database']['password'];
            
            mysqli_connect("localhost", $db_usuario, $db_senha, "dataBase");

            $query = "";
        	
                
        
        ?>
        <div></div>
        
    </body>
</html>