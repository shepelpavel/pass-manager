<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

// получение страницы содержимого каталога
$connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));

// получение выбранного каталога
$query_folder = 'SELECT * FROM `groups` WHERE `name` = "'.$_POST['path'].'"';
$folder = mysqli_query($connect, $query_folder) or die("Error " . mysqli_error($connect));
if ($folder) {
	$folder = $folder->fetch_assoc();
}
if ($_POST['path'] == '/') {
	$folder['name'] = 'home';
	$folder['title'] = 'HOME';
}

// получение каталогов внутри выбранного каталога
$query_folders = 'SELECT * FROM `groups` WHERE `path` = "'.$_POST['path'].'"';
$folders = mysqli_query($connect, $query_folders) or die("Error " . mysqli_error($connect));
$folders_res = array();
while ($folders_arr = $folders->fetch_assoc()) {
	$folders_res[] = $folders_arr;
}

// получение паролей внутри выбранного каталога
$query_pass = 'SELECT * FROM `passwd` WHERE `path` = "'.$_POST['path'].'"';
$pass = mysqli_query($connect, $query_pass) or die("Error " . mysqli_error($connect));
$pass_res = array();
while ($pass_arr = $pass->fetch_assoc()) {
	$pass_res[] = $pass_arr;
}
mysqli_close($connect);
?>

<h2><?= $folder['title'] ?></h2>
<?php if ($folder['name'] != 'home') { ?>
	<p class="link js-tree-path" target="<?= $folder['path'] ?>">Назад</p>
<?php } ?>
<p>
	<ul>
		<?php foreach ($folders_res as $key => $value) { ?>
			<li class="link js-tree-path" target="<?= $value['name'] ?>"><?= $value['title'] ?></li>
		<?php } ?>
		<?php foreach ($pass_res as $key => $value) { ?>
			<li class="link js-pass-title" target="<?= $value['name'] ?>"><?= $value['title'] ?></li>
		<?php } ?>
	</ul>
</p>
