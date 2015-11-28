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
	<?php require ASSETS_PATH . 'header.php' ?>
</head>
<body>
	<?php require ASSETS_PATH . 'navbar.php' ?>
	<div class="container main-container">
		<!-- COMPLETAR -->
	</div>
</body>
</html>