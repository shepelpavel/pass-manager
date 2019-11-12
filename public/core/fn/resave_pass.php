<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

$connect = mysqli_connect($host, $user, $password, $database)
    or die("error");

mysqli_set_charset($connect, "utf8");

$query_del = 'DELETE FROM `passwd`
    WHERE
        `name` = "'.$_POST['oldname'].'"
    AND
        `fullpath` = "'.$_POST['fullpath'].'"';

$result_del = mysqli_query($connect, $query_del)
    or die("error");

if ($result_del) {
    $query = "INSERT INTO passwd (
        `name`,`title`,`path`,`fullpath`,`login`,`pass`,`link`,`note`
        ) values(
            '".$_POST['name']."',
            '".$_POST['title']."',
            '".$_POST['path']."',
            '".$_POST['fullpath']."',
            '".$_POST['login']."',
            '".$_POST['pass']."',
            '".$_POST['link']."',
            '".$_POST['note']."'
            )";
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