<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
session_start();

if ($_POST['path'] == 'HOME') {
    $_SESSION['path']           = '';
} else {
    $_SESSION['path']           = $_POST['path'];
}
$_SESSION['fullpath']           = $BASEPATH.$_SESSION['path'];
$_SESSION['backpath']           = substr($_SESSION['path'], 0, strrpos($_SESSION['path'], '/'));
if ($_SESSION['backpath'] == '') {
    $_SESSION['backpath']       = 'HOME';
}

$_SESSION['folders_res']        = array_diff(scandir($_SESSION['fullpath']), array('..', '.'));

if ($_SESSION['path'] != '') {
    $bread_in                   = $_SESSION['path'];
    $breadcrumbs                = [];
    while ($bread_in != '') {
        $bread_name             = substr($bread_in, strrpos($bread_in, '/')+1);
        $bread_link             = $bread_in = substr($bread_in, 0, strrpos($bread_in, '/'));
        $breadcrumbs[]          = [
            'name'                  => $bread_name,
            'link'                  => $bread_link.'/'.$bread_name
        ];
    }
    $_SESSION['breadcrumbs']    = array_reverse($breadcrumbs);
} else {
    $_SESSION['breadcrumbs']    = [];
}

?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/chunks/block/menu.php'; ?>

<div class="content">

    <h2><?= $_SESSION['path'] == '' ? 'HOME' : basename($_SESSION['fullpath']) ?></h2>

    <div class="breadcrumbs">
        <?php if ($_SESSION['path'] != '') {
        echo '<div class="breadcrumbs__link js-tree-path" target="HOME">HOME</div>';
        foreach ($_SESSION['breadcrumbs'] as $crumb) {
            if (next($_SESSION['breadcrumbs'])) {
                echo '<div class="breadcrumbs__arrow"> > </div><div class="breadcrumbs__link js-tree-path" target="'.$crumb['link'].'">'.$crumb['name'].'</div>';
            } else {
                echo '<div class="breadcrumbs__arrow"> > </div><div class="breadcrumbs__nolink">'.$crumb['name'].'</div>';
            }
        }
    } ?>
    </div>

    <?php if ($_SESSION['path'] != '') { ?>
    <div class="controls">
        <div class="controls__link js-tree-path" target="<?= $_SESSION['backpath'] ?>">
            <img class="controls__link_icon" src="/_assets/img/svg/left-arrow.svg" alt="Back">
        </div>
        <div class="controls__link js-tree-path" target="HOME">
            <img class="controls__link_icon" src="/_assets/img/svg/home.svg" alt="Home">
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($_SESSION['folders_res'])) { ?>

    <div class="tree">
        <?php foreach ($_SESSION['folders_res'] as $value) { ?>
        <?php if (is_dir($_SESSION['fullpath'].'/'.$value)) { ?>
        <div class="tree__item tree__item_folder js-tree-item">
            <div class="tree__item_link js-tree-path js-tree-name" target="<?= $_SESSION['path'].'/'.$value ?>"
                type="groups">
                <?= $value ?>
            </div>
            <div class="tree__item_more js-more">
                <div class="more__modal js-more-modal">
                    <div class="more__modal_item more__modal_item_edit js-folder-edit">
                        <img src="/_assets/img/svg/edit.svg" alt="Edit">
                        Изменить
                    </div>
                    <div class="more__modal_item more__modal_item_del js-tree-del">
                        <img src="/_assets/img/svg/trash.svg" alt="Delete">
                        Удалить
                    </div>
                </div>
                <div class="more__anim js-more-anim"></div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php foreach ($_SESSION['folders_res'] as $value) { ?>
        <?php if (!is_dir($_SESSION['fullpath'].'/'.$value) && stripos($value, '.json') > 0) { ?>
        <div class="tree__item tree__item_passwd js-tree-item">
            <div class="tree__item_link js-pass-title js-tree-name" target="<?= $_SESSION['path'].'/'.$value ?>"
                type="passwd">
                <?= json_decode(file_get_contents($_SESSION['fullpath'].'/'.$value), true)['title'] ?>
            </div>
            <div class="tree__item_more js-more">
                <div class="more__modal js-more-modal">
                    <div class="more__modal_item more__modal_item_edit js-pass-title js-tree-name"
                        target="<?= $_SESSION['path'].'/'.$value ?>" type="passwd">
                        <img src="/_assets/img/svg/edit.svg" alt="Edit">
                        Изменить
                    </div>
                    <div class="more__modal_item more__modal_item_del js-tree-del">
                        <img src="/_assets/img/svg/trash.svg" alt="Delete">
                        Удалить
                    </div>
                </div>
                <div class="more__anim js-more-anim"></div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    </div>

    <?php } else { ?>

    <div class="tree">
        <div class="empty">Каталог пуст</div>
    </div>

    <?php } ?>

</div>

<?php session_write_close(); ?>