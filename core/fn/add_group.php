<?php
// include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
// $connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));
// 
// $query = "INSERT INTO groups (name) values('".$_POST['name']."')";
// $result = mysqli_query($connect, $query) or die("Error " . mysqli_error($connect));
// 
// if ($result) {
//     echo '<pre>'; print_r($result); echo '</pre>';
// }
// 
// mysqli_close($connect);
echo 'name - '.$_POST['name'].', title - '.$_POST['title'].', path - '.$_POST['path'];
?>
<p class="link js-tree-path" target="<?= $_POST['path'] ?>">Ok</p>
