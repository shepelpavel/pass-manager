<?php
session_start();

if($_SESSION['admin']){
	header("Location: /admin.php");
	exit;
}

include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

$connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));
$query = "SELECT * FROM auth WHERE id = 1";
$result = mysqli_query($connect, $query) or die("Error " . mysqli_error($connect)); 
if ($result) {
	$result = $result->fetch_assoc();
}
mysqli_close($connect);

$admin = $result['login'];
$pass = $result['pass'];

if ($_POST['submit']) {
	if ($_POST['user'] == $admin && md5($sault . md5($_POST['pass'])) == $pass) {
		$_SESSION['admin'] = $admin;
		header("Location: /admin.php");
		exit;
	} else echo '<p>Логин или пароль неверны!</p>';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>enter</title>
</head>
<body>
	
	Это страница авторизации.
	<br />
	<form method="post">
		Username: <input type="text" name="user" /><br />
		Password: <input type="password" name="pass" /><br />
		<input type="submit" name="submit" value="Войти" />
	</form>
	
</body>
</html>
