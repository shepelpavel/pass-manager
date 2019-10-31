<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

// получение страницы содержимого каталога
$connect = mysqli_connect($host, $user, $password, $database)
	or die("error");

mysqli_set_charset($connect, "utf8");

// получение выбранного каталога
$query_folder = 'SELECT * FROM `groups` WHERE `name` = "'.$_POST['path'].'"';
$folder = mysqli_query($connect, $query_folder) or die("error");
if ($folder) {
	$folder = $folder->fetch_assoc();
}
if ($_POST['path'] == 'HOME') {
	$folder['name'] = 'HOME';
	$folder['title'] = 'HOME';
	$folder['path'] = 'HOME';
	$folder['fullpath'] = 'HOME';
}

// получение каталогов внутри выбранного каталога
$query_folders = 'SELECT * FROM `groups` WHERE `path` = "'.$_POST['path'].'" ORDER BY `title` ASC';
$folders = mysqli_query($connect, $query_folders) or die("error");
$folders_res = array();
while ($folders_arr = $folders->fetch_assoc()) {
	$folders_res[] = $folders_arr;
}

// получение паролей внутри выбранного каталога
$query_pass = 'SELECT * FROM `passwd` WHERE `path` = "'.$_POST['path'].'" ORDER BY `title` ASC';
$pass = mysqli_query($connect, $query_pass) or die("error");
$pass_res = array();
while ($pass_arr = $pass->fetch_assoc()) {
	$pass_res[] = $pass_arr;
}

// получение хлебных крошек
$fldr = $folder['name'];
$pth = $folder['path'];
$bread[] = [
	'name' => $folder['name'],
	'title' => $folder['title'],
	'path' => $folder['path'],
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

mysqli_close($connect);

// формирование хлебных крошек
$breadcrumbs = '';
$i = 0;
foreach ($bread as $crumb) {
	if ($crumb['name'] != 'HOME' && $crumb['name'] != '') {
		if ($i == 0) { 
			$breadcrumbs = '<div class="breadcrumbs__arrow"> > </div><div class="breadcrumbs__nolink">'.$crumb['title'].'</div>';
		} else {
			$breadcrumbs = '<div class="breadcrumbs__arrow"> > </div><div class="breadcrumbs__link js-tree-path" target="'.$crumb['name'].'">
			'.$crumb['title'].'</div>'.$breadcrumbs;
		}
	}
	$i++;
}

// запись в сессию текущего каталога
session_start();
$_SESSION['folder'] = [
	'name' => $folder['name'],
	'title' => $folder['title'],
	'path' => $folder['path'],
	'fullpath' => $folder['fullpath'],
];
session_write_close();
?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/chunks/block/menu.php'; ?>

<div class="content">

	<h2 class="js-title" this-path="<?= $folder['name'] ?>" this-fullpath="<?= $folder['fullpath'] ?>">
		<?= $folder['title'] ?>
	</h2>

	<div class="breadcrumbs">
		<?= $folder['name'] != 'HOME' ? '<div class="breadcrumbs__link js-tree-path" target="HOME">HOME</div>' . $breadcrumbs : '' ?>
	</div>

	<?php if ($folder['name'] != 'HOME') { ?>
	<div class="controls">
		<div class="controls__link js-tree-path" target="<?= $folder['path'] ?>">
			<img class="controls__link_icon" src="/_assets/img/svg/left-arrow.svg" alt="Home">
		</div>
		<div class="controls__link js-tree-path" target="HOME">
			<img class="controls__link_icon" src="/_assets/img/svg/home.svg" alt="Home">
		</div>
	</div>
	<?php } ?>

	<?php if (!empty($folders_res) || !empty($pass_res)) { ?>

	<div class="tree">
		<?php foreach ($folders_res as $key => $value) { ?>
		<div class="tree__item tree__item_folder js-tree-item">
			<div class="tree__item_link js-tree-path js-tree-name" target="<?= $value['name'] ?>" type="groups">
				<?= $value['title'] ?>
			</div>
			<div class="tree__item_del js-del-btn">
				<div class="del__btn js-tree-del"></div>
				<div class="del__anim js-del-anim"></div>
			</div>
		</div>
		<?php } ?>

		<?php foreach ($pass_res as $key => $value) { ?>
		<div class="tree__item tree__item_passwd js-tree-item">
			<div class="tree__item_link js-pass-title js-tree-name" target="<?= $value['name'] ?>" type="passwd">
				<?= $value['title'] ?>
			</div>
			<div class="tree__item_del js-del-btn">
				<div class="del__btn js-tree-del"></div>
				<div class="del__anim js-del-anim"></div>
			</div>
		</div>
		<?php } ?>
	</div>

	<?php } else { ?>

	<div class="tree">
		<div class="empty">Каталог пуст</div>
	</div>

	<?php } ?>

</div>