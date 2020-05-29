<?php
include $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';
session_start();

function getDirContents($dir, $len, &$results = array())
{
    $files = scandir($dir);
    foreach ($files as $value) {
        $path = $dir . DIRECTORY_SEPARATOR . $value;
        if (!is_dir($path)) {
            $results[] = substr($path, $len + 1);
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $len, $results);
        }
    }
    return $results;
}

$all_json = getDirContents($BASEPATH, strlen($BASEPATH));

?>

<div class="content allpass">

    <h2>All pass</h2>

    <div class="allpass__buttons">
        <div class="button allpass__buttons_button allpass__buttons_decrypt js-decrypt-all">
            Decrypt all
        </div>
        <div class="button allpass__buttons_button allpass__buttons_backup js-make-backup">
            Make backup
        </div>
    </div>

    <?php foreach ($all_json as $val) {
        $file_res = json_decode(file_get_contents($BASEPATH . $val), true);
    ?>
        <div class="allpass__item js-allpass-item">
            <div class="allpass__item_field allpass__item_name js-allpass-path"><?= $val ?></div>
            <div class="allpass__item_field js-allpass-field js-allpass-login"><?= $file_res['login'] ?></div>
            <div class="allpass__item_field js-allpass-field js-allpass-pass"><?= $file_res['pass'] ?></div>
            <div class="allpass__item_field js-allpass-field js-allpass-link"><?= $file_res['link'] ?></div>
            <div class="allpass__item_field js-allpass-field js-allpass-note"><?= $file_res['note'] ?></div>
        </div>
    <?php } ?>

</div>

<?php session_write_close(); ?>