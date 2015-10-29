<?php
	$db_file = file_get_contents('private.json');
	$db_json = json_decode($db_file, true);
	
	$db_servidor = $db_json['database']['server'];
	$db_usuario = $db_json['database']['username'];
	$db_senha = $db_json['database']['password'];

	function votacoesCriadas($id){
		$conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
		$query = mysqli_query($conexao, "SELECT * FROM votacao WHERE autor_id = '" .$id ."'");
		$resultado = array();
		while($row = mysqli_fetch_array())
			array_push($resultado, $row);
		mysqli_close($conexao);
		return $resultado;
	}
?>