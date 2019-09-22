<?php
session_start();

if($_GET['do'] == 'logout'){
	unset($_SESSION['admin']);
	unset($_SESSION['decryptor']);
	session_destroy();
}

if(!$_SESSION['admin'] || !$_SESSION['decryptor']){
	header("Location: /index.php");
	exit;
}
session_write_close();
?>
