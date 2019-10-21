<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
$connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));
mysqli_set_charset($connect, "utf8");
$query = 'DELETE FROM `'.$_POST['type'].'` WHERE `name` = "'.$_POST['name'].'"';
$result = mysqli_query($connect, $query) or die("Error " . mysqli_error($connect));
mysqli_close($connect);
?>