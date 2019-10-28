<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

// получение массива значений полей пароля
$connect = mysqli_connect($host, $user, $password, $database)
	or die("Error " . mysqli_error($connect));

mysqli_set_charset($connect, "utf8");

$query_pass = 'SELECT * FROM `passwd`';
$pass = mysqli_query($connect, $query_pass) or die("Error " . mysqli_error($connect));

if ($pass) {
	$all_pass = $pass->fetch_assoc();
}

mysqli_close($connect);
echo $all_pass;
?>
