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
    $queryfirst = "UPDATE `groups`
        SET
            `name` = '".$_POST['name']."',
            `title` = '".$_POST['title']."',
            `fullpath` = '".$_POST['fullpath']."'
        WHERE `name` = '".$_POST['oldname']."'";
    $querysecond = "UPDATE `pass`
        SET
            `path` = '".$_POST['path']."',
            `fullpath` = '".$_POST['fullpath']."'
        WHERE `path` = '".$_POST['oldname']."'";

    $resultfirst = mysqli_query($connect, $queryfirst)
        or die("error");
    $resultsecond = mysqli_query($connect, $querysecond)
        or die("error");
        
    if ($resultfirst && $resultsecond) {
        echo 'ok';
    } else {
        echo 'error';
    }
}

mysqli_close($connect);
?>