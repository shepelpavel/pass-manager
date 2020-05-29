<?php
include $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';

$inner = $_POST['inner'];
$html = '
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>backup</title></head>
<body>' . $inner . '</body></html>';

$preffix = date("_Y-m-d_H-i-s");
$html_file = $BASEPATH . $_SERVER['PHP_AUTH_USER'] . $preffix . '_bckp.html';
$zip_file = $BASEPATH . $_SERVER['PHP_AUTH_USER'] . $preffix . '_bckp.zip';

$bckp_html_file = fopen($html_file, 'w');
fwrite($bckp_html_file, $html);
fclose($bckp_html_file);

$exec_zip = system('zip -P ' . $_SERVER['PHP_AUTH_PW'] . ' ' . $zip_file . ' ' . $html_file);
unlink($html_file);

$result = 'true';

echo $result;
// echo '<pre>'; print_r($result); echo '</pre>';

session_write_close();
return;
