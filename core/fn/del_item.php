<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

$connect = mysqli_connect($host, $user, $password, $database)
    or die("error");

mysqli_set_charset($connect, "utf8");

if ($_POST['type'] == 'groups') {
    $query_folders = 'DELETE FROM `groups` WHERE `fullpath` like "%'.$_POST['name'].'%"';
    $result_folders = mysqli_query($connect, $query_folders) or die("error");

    $query_pass = 'DELETE FROM `passwd` WHERE `fullpath` like "%'.$_POST['name'].'%"';
    $result_pass = mysqli_query($connect, $query_pass) or die("error");
} elseif ($_POST['type'] == 'passwd') {
    $query = 'DELETE FROM `passwd` WHERE `name` = "'.$_POST['name'].'" AND `fullpath` = "'.$_POST['fullpath'].'"';
    $result = mysqli_query($connect, $query) or die("error");
} else {
    echo 'error';
}

mysqli_close($connect);
?>