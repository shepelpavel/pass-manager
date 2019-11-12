<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

$connect = mysqli_connect($host, $user, $password, $database)
    or die("error");

mysqli_set_charset($connect, "utf8");

$query_check = 'SELECT * FROM `groups` WHERE `name` = "'.$_POST['name'].'"';
$result_check = mysqli_query($connect, $query_check) or die("error");

if ($result_check) {
    $result_check = $result_check->fetch_assoc();
}

if (!empty($result_check)) {
    echo 'exist';
} else {
    $query = "INSERT INTO groups (`name`,`title`,`path`,`fullpath`)
        values( '".$_POST['name']."',
                '".$_POST['title']."',
                '".$_POST['path']."',
                '".$_POST['fullpath']."')";

    $result = mysqli_query($connect, $query)
        or die("error");

    if ($result) {
        echo 'ok';
    } else {
        echo 'error';
    }
}

mysqli_close($connect);
?>