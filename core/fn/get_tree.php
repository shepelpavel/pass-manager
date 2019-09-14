<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

// Получение массива каталогов
$connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));
$query = 'SELECT * FROM `groups` WHERE `path` = "'.$_POST['path'].'"';
$folders = mysqli_query($connect, $query) or die("Error " . mysqli_error($connect));
$folders_res = array();
while ($folders_arr = $folders->fetch_assoc()) {
	$folders_res[] = $folders_arr;
}
mysqli_close($connect);
?>

<ul>
    <li class="link js-tree-path" target="/">HOME</a></li>
    <?php foreach ($folders_res as $key => $value) { ?>
        <li class="link js-tree-path" target="<?= $value['name'] ?>"><?= $value['title'] ?></li>
    <?php } ?>
</ul>
