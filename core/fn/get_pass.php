<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

// получение массива значений полей пароля
$connect = mysqli_connect($host, $user, $password, $database)
	or die("error");

mysqli_set_charset($connect, "utf8");

$query_pass = 'SELECT * FROM `passwd` WHERE `name` = "'.$_POST['name'].'"';
$pass = mysqli_query($connect, $query_pass) or die("error");
if ($pass) {
	$pass = $pass->fetch_assoc();
}

// получение хлебных крошек
session_start();

$fldr = $_SESSION['folder']['name'];
$pth = $_SESSION['folder']['path'];
$bread[] = [
	'name' => $_SESSION['folder']['name'],
	'title' => $_SESSION['folder']['title'],
	'path' => $_SESSION['folder']['path'],
];
while ($fldr != 'HOME' && $pth != 'HOME' && $i < 10) {
	$i++;
	$query_fldr = 'SELECT * FROM `groups` WHERE `name` = "'.$pth.'"';
	$response = mysqli_query($connect, $query_fldr) or die("error");
	if ($response) {
		$response = $response->fetch_assoc();
	}
	$fldr = $response['name'];
	$pth = $response['path'];
	$bread[] = $response;
}

session_write_close();

// формирование хлебных крошек
$breadcrumbs = '';
foreach ($bread as $crumb) {
	if ($crumb['name'] != 'HOME' && $crumb['name'] != '') {
		$breadcrumbs = '<div class="breadcrumbs__arrow"> > </div><div class="breadcrumbs__link js-tree-path" target="'.$crumb['name'].'">
		'.$crumb['title'].'</div>'.$breadcrumbs;
	}
	$i++;
}

mysqli_close($connect);

?>

<div class="content">

	<h2 class="js-title" this-path="<?= $pass['path'] ?>" this-fullpath="<?= $pass['fullpath'] ?>"
		this-name="<?= $pass['name'] ?>"><?= $pass['title'] ?></h2>

	<div class="breadcrumbs">
		<div class="breadcrumbs__link js-tree-path" target="HOME">HOME</div><?= $breadcrumbs ?><div
			class="breadcrumbs__arrow"> > </div>
		<div class="breadcrumbs__nolink"><?= $pass['title'] ?></div>
	</div>

	<div class="controls">
		<div class="controls__link js-tree-path" target="<?= $pass['path'] ?>">
			<img class="controls__link_icon" src="/_assets/img/svg/left-arrow.svg" alt="Back">
		</div>
		<div class="controls__link js-tree-path" target="HOME">
			<img class="controls__link_icon" src="/_assets/img/svg/home.svg" alt="Home">
		</div>
	</div>

	<div class="pass">
		<div class="pass__input pass__input_title">
			<input class="js-input-title" type="text" name="title" value="<?= $pass['title'] ?>">
			<img class="pass__input_copy js-pass-copy" src="/_assets/img/svg/copy.svg" alt="Copy">
		</div>
		<div class="pass__input pass__input_link">
			<input class="js-input-link js-crypt" type="text" name="link" value="<?= $pass['link'] ?>">
			<img class="pass__input_copy js-pass-copy" src="/_assets/img/svg/copy.svg" alt="Copy">
		</div>
		<div class="pass__input pass__input_login">
			<input class="js-input-login js-crypt" type="text" name="login" value="<?= $pass['login'] ?>">
			<img class="pass__input_copy js-pass-copy" src="/_assets/img/svg/copy.svg" alt="Copy">
		</div>
		<div class="pass__input pass__input_pass">
			<input class="js-input-pass js-crypt" type="text" name="pass" value="<?= $pass['pass'] ?>">
			<img class="pass__input_copy js-pass-copy" src="/_assets/img/svg/copy.svg" alt="Copy">
		</div>
		<div class="pass__input pass__input_note">
			<textarea class="js-input-note js-crypt" name="note" rows="8" cols="80"><?= $pass['note'] ?></textarea>
		</div>

		<div class="pass__buttons">
			<div class="pass__buttons_link js-pass-save">Сохранить</div>
			<div class="pass__buttons_link js-tree-path" target="<?= $pass['path'] ?>">Отмена</div>
		</div>
	</div>

</div>