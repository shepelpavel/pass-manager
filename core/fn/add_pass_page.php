<?php 

include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

$connect = mysqli_connect($host, $user, $password, $database)
or die("error");

mysqli_set_charset($connect, "utf8");

session_start();

// получение хлебных крошек
$fldr = $_SESSION['folder']['name'];
$pth = $_SESSION['folder']['path'];
$bread[] = [
	'name' => $_SESSION['folder']['name'],
	'title' => $_SESSION['folder']['title'],
	'path' => $_SESSION['folder']['path'],
];
while ($fldr != 'HOME' && $pth != 'HOME' && $i < 10) {
	$i++;
	$query_fldr = 'SELECT * FROM `groups` WHERE `name` = "'.$pth.'"';
	$response = mysqli_query($connect, $query_fldr) or die("error");
	if ($response) {
		$response = $response->fetch_assoc();
	}
	$fldr = $response['name'];
	$pth = $response['path'];
	$bread[] = $response;
}

session_write_close();

// формирование хлебных крошек
$breadcrumbs = '';
foreach ($bread as $crumb) {
	if ($crumb['name'] != 'HOME' && $crumb['name'] != '') {
		$breadcrumbs = '<div class="breadcrumbs__arrow"> > </div><div class="breadcrumbs__link js-tree-path" target="'.$crumb['name'].'">
		'.$crumb['title'].'</div>'.$breadcrumbs;
	}
	$i++;
}

?>

<div class="content">

    <h2 class="js-title" this-path="<?= $_SESSION['folder']['name'] ?>"
        this-fullpath="<?= $_SESSION['folder']['fullpath'] ?>">
        Add pass
    </h2>

    <div class="breadcrumbs">
        <div class="breadcrumbs__link js-tree-path" target="HOME">HOME</div><?= $breadcrumbs ?><div
            class="breadcrumbs__arrow"> > </div>
    </div>

    <div class="controls">
        <div class="controls__link js-tree-path" target="<?= $_SESSION['folder']['path'] ?>">
            <img class="controls__link_icon" src="/_assets/img/svg/left-arrow.svg" alt="Back">
        </div>
        <div class="controls__link js-tree-path" target="HOME">
            <img class="controls__link_icon" src="/_assets/img/svg/home.svg" alt="Home">
        </div>
    </div>

    <div class="pass">
        <div class="pass__input pass__input_title">
            <input class="js-input-title" type="text" name="title" value="">
        </div>
        <div class="pass__input pass__input_link">
            <input class="js-input-link js-crypt" type="text" name="link" value="">
            <img class="pass__input_copy js-pass-copy" src="/_assets/img/svg/copy.svg" alt="Copy">
        </div>
        <div class="pass__input pass__input_login">
            <input class="js-input-login js-crypt" type="text" name="login" value="">
            <img class="pass__input_copy js-pass-copy" src="/_assets/img/svg/copy.svg" alt="Copy">
        </div>
        <div class="pass__input pass__input_pass">
            <input class="js-input-pass js-crypt" type="text" name="pass" value="">
            <img class="pass__input_copy js-pass-copy" src="/_assets/img/svg/copy.svg" alt="Copy">
        </div>
        <div class="pass__input pass__input_note">
            <textarea class="js-input-note js-crypt" name="note" rows="8" cols="80"></textarea>
        </div>

        <div class="pass__buttons">
            <div class="pass__buttons_link js-newpass-save">Сохранить</div>
            <div class="pass__buttons_link js-tree-path" target="<?= $_SESSION['folder']['path'] ?>">Отмена</div>
        </div>
    </div>

</div>