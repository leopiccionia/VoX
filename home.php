<!DOCTYPE html>
<?php
	if(empty($_SESSION['logado'])){
		header('Location: /index.php');
		die();
	}
	$id = $_SESSION['id'];
?>
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