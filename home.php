<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: /index.php');
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>VoX</title>
	<?php require 'assets/header.php' ?>
</head>
<body>
	<?php require 'assets/navbar.php' ?>
	<div class="container main-container">
		<!-- COMPLETAR -->
	</div>
</body>
</html>