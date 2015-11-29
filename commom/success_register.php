<?php
	if (session_status() == PHP_SESSION_NONE) 
    	session_start();

    if(isset($_SESSION['success']))
    	$success_message = $_SESSION['success'];
?>

<?php if(isset($success_message)): ?>
	<div class="alert alert-success">
	    <button type="button" class="close" data-dismiss="alert">
	        <i class="glyphicon glyphicon-remove"></i>
	    </button>
	    <h2><?php $success_message; ?></h2>
	</div>		
<?php endif; unset($_SESSION['success']); ?>