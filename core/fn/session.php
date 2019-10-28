<?php
session_start();

if (!$_SESSION['key']) {
    include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
    
    $connect = mysqli_connect($host, $user, $password, $database)
        or die("error");

    mysqli_set_charset($connect, "utf8");

    $query = "SELECT * FROM `key` WHERE `id` = 1";
    $result = mysqli_query($connect, $query) or die("error"); 
    if ($result) {
        $result = $result->fetch_assoc();
    }
    mysqli_close($connect);
    
    $_SESSION['key'] = $result['key'];
}

session_write_close();
?>