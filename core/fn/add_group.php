<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
$connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));
mysqli_set_charset($connect, "utf8");
$query = "INSERT INTO groups (`name`,`title`,`path`) values('".$_POST['name']."','".$_POST['title']."','".$_POST['path']."')";
$result = mysqli_query($connect, $query) or die("Error " . mysqli_error($connect));
mysqli_close($connect);

if ($result) { ?>
    <p class="link js-tree-path" target="<?= $_POST['path'] ?>">Ok</p>
<?php } else { ?>
    <p class="link js-tree-path" target="/">Error!</p>
<?php } ?>