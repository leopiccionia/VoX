<!DOCTYPE html>
<html>
<head>
	<title>VoX</title>
	<?php require 'assets/header.php' ?>
</head>
<body>
	<div class="container">
		<div class="jumbotron">
    			<h1>✔o✘</h1>      
    			<p>Proponha. Discuta. Vote.</p>      
  		</div>
  		<div class="login">
  			<h2>Cadastre-se</h2>
  			<form action="cadastro.php" method="post">
		  		<input type="text" id="cadastro_usuario" name="cadastro_usuario" class="form-control" placeholder="Seu nome de usuário" required>
		  		<input type="email" id="cadastro_email" name="cadastro_email" class="form-control" placeholder="Seu e-mail" required>
		  		<input type="password" id="cadastro_senha" name="cadastro_senha" class="form-control" placeholder="Sua senha" required>
		  		<input type="password" id="cadastro_senha2" name="cadastro_senha2" class="form-control" placeholder="Repita sua senha" required>
		  		<input type="submit" class="btn btn-primary" value="Cadastre-se agora!">
		  	</form>
		  	<h2>Já é cadastrado?</h2>
		  	<form action="login.php" method="post">
		  		<input type="text" id="login_credencial" name="login_credencial" class="form-control" placeholder="Seu nome de usuário ou e-mail" required>
		  		<input type="password" id="login_senha" name="login_senha" class="form-control" placeholder="Sua senha" required>
		  		<input type="submit" class="btn btn-primary" value="Entrar">
		  	</form>
  		</div>
	</div>
</body>
</html>