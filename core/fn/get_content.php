<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

// получение страницы содержимого каталога
$connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));
mysqli_set_charset($connect, "utf8");
// получение выбранного каталога
$query_folder = 'SELECT * FROM `groups` WHERE `name` = "'.$_POST['path'].'"';
$folder = mysqli_query($connect, $query_folder) or die("Error " . mysqli_error($connect));
if ($folder) {
	$folder = $folder->fetch_assoc();
}
if ($_POST['path'] == '/') {
	$folder['name'] = '/';
	$folder['title'] = 'HOME';
	$folder['path'] = '/';
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

$fldr = $folder['name'];
$pth = $folder['path'];
$bread[] = [
	'name' => $folder['name'],
	'title' => $folder['title'],
	'path' => $folder['path'],
];
while ($fldr != '/' && $pth != '/' && $i < 10) {
	$i++;
	$query_fldr = 'SELECT * FROM `groups` WHERE `name` = "'.$pth.'"';
	$response = mysqli_query($connect, $query_fldr) or die("Error " . mysqli_error($connect));
	if ($response) {
		$response = $response->fetch_assoc();
	}
	$fldr = $response['name'];
	$pth = $response['path'];
	$bread[] = $response;
}

mysqli_close($connect);

$breadcrumbs = '';
foreach ($bread as $crumb) {
	if ($crumb['name'] != '/') {
		$breadcrumbs = ' > ' . $crumb['title'] . $breadcrumbs;
	}
}

session_start();
$_SESSION['folder'] = [
	'name' => $folder['name'],
	'title' => $folder['title'],
];
session_write_close();
?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/chunks/block/menu.php'; ?>

<h2 class="js-title" this-path="<?= $folder['name'] ?>"><?= $folder['title'] ?></h2>
<?= $folder['name'] != '/' ? 'HOME ' . $breadcrumbs : '' ?>
<?php if ($folder['name'] != '/') { ?>
<p class="link js-tree-path" target="/">ГЛАВНАЯ</p>
<p class="link js-tree-path" target="<?= $folder['path'] ?>">Назад</p>
<?php } ?>
<?php if (!empty($folders_res) || !empty($pass_res)) { ?>
<p>
	<ul>
		<?php foreach ($folders_res as $key => $value) { ?>
		<li class="tree__item js-tree-item">
			<div class="link js-tree-path js-tree-name" target="<?= $value['name'] ?>" type="groups">
				<?= $value['title'] ?>
			</div>
			<div class="btn tree__item_del js-tree-del">del</div>
		</li>
		<?php } ?>
		<?php foreach ($pass_res as $key => $value) { ?>
		<li class="tree__item js-tree-item">
			<div class="link js-pass-title js-tree-name" target="<?= $value['name'] ?>" type="passwd">
				<?= $value['title'] ?>
			</div>
			<div class="btn tree__item_del js-tree-del">del</div>
		</li>
		<?php } ?>
	</ul>
</p>
<?php } else { ?>
<p>Каталог пуст</p>
<?php } ?>

<div class="modals js-modal-close">
	<?php include $_SERVER['DOCUMENT_ROOT'].'/chunks/block/modals.php'; ?>
</div>