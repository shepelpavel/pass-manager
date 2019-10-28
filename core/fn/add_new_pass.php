<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

$connect = mysqli_connect($host, $user, $password, $database)
    or die("Error " . mysqli_error($connect));

mysqli_set_charset($connect, "utf8");

$query_check = 'SELECT * FROM `passwd`
    WHERE `name` = "'.$_POST['name'].'"
    AND `path` = "'.$_POST['path'].'"';

$result_check = mysqli_query($connect, $query_check)
    or die("Error " . mysqli_error($connect));

if ($result_check) {
    $result_check = $result_check->fetch_assoc();
}

if (!empty($result_check)) {
    echo 'pass exist';
} else {
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
        or die("Error " . mysqli_error($connect));
        
    if ($result) {
        echo 'Ok';
    } else {
        echo 'Error!';
    }
}

mysqli_close($connect);
?>