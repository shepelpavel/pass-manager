<?php

include $_SERVER['DOCUMENT_ROOT'].'/chunks/html/header.php';

if ($_POST['submit']) {
    if ($_POST['pass_first'] == $_POST['pass_second'] && strlen($_POST['pass_first']) > 5) {
        
        $new_pass = md5($sault . md5($_POST['pass_first']));
        $new_key = md5($new_pass);
        
        $connect = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($connect));
        $query = "UPDATE auth SET pass = '".$new_pass."', decryptor = '".$new_key."' WHERE id = 1";
        $result = mysqli_query($connect, $query) or die("Error " . mysqli_error($connect)); 
        if ($result) {
            echo '<p>Пароль изменен</p>';
            unset($_SESSION['admin']);
            unset($_SESSION['decryptor']);
            session_destroy();
        }
        mysqli_close($connect);
        
    } else if ($_POST['pass_first'] == $_POST['pass_second']) {
        echo '<p>Слишком короткий пароль</p>';
    } else {
        echo '<p>Введены разные пароли</p>';
    }
}
?>

<p><a href="/change-pass.php">Изменить пароль</a> | <a href="/admin.php">Админка</a></p>
<hr />
Это страница изменения пароля.
<br />
<form method="post">
    New pass: <input type="password" name="pass_first" /><br />
    New pass again: <input type="password" name="pass_second" /><br />
    <input type="submit" name="submit" value="Изменить" />
</form>

<?php include $_SERVER['DOCUMENT_ROOT'].'/chunks/html/footer.php'; ?>
