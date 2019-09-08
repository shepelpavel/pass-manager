<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

if ($_POST['path'] == '/') {
	$folders = [
		'name' => 'home',
		'title' => 'HOME'
	];
} else {
	$connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));
	$query = 'SELECT * FROM `groups` WHERE `name` = "'.$_POST['path'].'"';
	$folders = mysqli_query($connect, $query) or die("Error " . mysqli_error($connect));
	if ($folders) {
		$folders = $folders->fetch_assoc();
	}
}
mysqli_close($connect);
?>

<h2><?= $folders['title'] ?></h2>
