<?php
	$db_file = file_get_contents("private.json");
	$db_json = json_decode($db_file, true);
	
	$db_servidor = $db_json['database']['server'];
	$db_usuario = $db_json['database']['username'];
	$db_senha = $db_json['database']['password'];

	function loginPorEmail($email, $senha){
		$conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
		
		$query = mysqli_query('SELECT nome FROM usuario WHERE email = "' . $email .'"');
		$nome;
		$id = -1; /*valor sentinela */
		while($row = mysqli_fetch_array($query)){
			$nome = $row['nome'];
			$hash_senha = sha1($senha .$nome);
		}
	   
		$query = mysqli_query('SELECT * FROM usuario WHERE email = "' .$email .'" AND senha = "' .$senha .'"');
		if($row = mysqli_fetch_array($query))
			$id = $row['usuario_id'];
		
		mysqli_close($conexao);
		if($id != -1)
			return array('logado' => true, 'id' => $id);
		return array('logado' => false);
	}
	
	function loginPorNome($nome, $senha){
		$conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
		$hash_senha = sha1($senha .$nome);
		
		$query = mysqli_query('SELECT * FROM usuario WHERE nome = "' . $nome . '" AND senha = "' .$senha .'"');
		$id = -1; /*valor sentinela */
		if($row = mysqli_fetch_array($query))
			$id = $row['usuario_id'];

		mysqli_close($conexao);
		if($id != -1)
			return array('logado' => true, 'id' => $id);
		return array('logado' => false);
	}
	
	function votacoesCriadas($id){
		$conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
		$query = mysqli_query('SELECT * FROM votacao WHERE autor_id = "' .$id .'"');
		$resultado = array();
		while($row = mysqli_fetch_array())
			array_push($resultado, $row);
		mysqli_close($conexao);
		return $resultado;
	}

?>