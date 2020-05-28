<?php

// data
$BASEPATH       = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos($_SERVER['DOCUMENT_ROOT'], '/')) . '/data/' . $_SERVER['PHP_AUTH_USER'] . '/';
echo '<pre>'; print_r($BASEPATH); echo '</pre>';

// meta
$title          = 'PssMgr';

// version
$ver            = '?v=0.1.6';
