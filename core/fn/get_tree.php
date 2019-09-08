<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

$connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));
$query = 'SELECT * FROM `groups` WHERE `path` = "'.$_POST['path'].'"';
$folders = mysqli_query($connect, $query) or die("Error " . mysqli_error($connect));
if ($folders) {
	$folders = $folders->fetch_all();
}
mysqli_close($connect);
?>

<ul>
    <li class="js-tree-path" target="/">HOME</a></li>
    <?php foreach ($folders as $key => $value) { ?>
        <li class="js-tree-path" target="<?= $value['1'] ?>"><?= $value['2'] ?></a></li>
    <?php } ?>
</ul>
