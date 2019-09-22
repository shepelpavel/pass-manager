<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

// получение массива значений полей пароля
$connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));
$query_pass = 'SELECT * FROM `passwd` WHERE `name` = "'.$_POST['name'].'"';
$pass = mysqli_query($connect, $query_pass) or die("Error " . mysqli_error($connect));
if ($pass) {
	$pass = $pass->fetch_assoc();
}
mysqli_close($connect);
?>

<h2><?= $pass['title'] ?></h2>
<p class="link js-tree-path" target="/">ГЛАВНАЯ</p>
<p class="link js-tree-path" target="<?= $pass['path'] ?>">Назад</p>
<input class="js-input-title" type="text" name="title" value="<?= $pass['title'] ?>">
<br>
<input class="js-input-link js-crypt" type="text" name="link" value="<?= $pass['link'] ?>">
<br>
<input class="js-input-login js-crypt" type="text" name="login" value="<?= $pass['login'] ?>">
<br>
<input class="js-input-pass js-crypt" type="text" name="pass" value="<?= $pass['pass'] ?>">
<br>
<textarea class="js-input-note js-crypt" name="note" rows="8" cols="80"><?= $pass['note'] ?></textarea>
