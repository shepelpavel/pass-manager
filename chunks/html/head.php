<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
?>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    
    <link rel="apple-touch-icon" sizes="180x180" href="/include/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/include/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/include/favicon/favicon-16x16.png">
    <link rel="manifest" href="/include/favicon/site.webmanifest">
    <link rel="mask-icon" href="/include/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/include/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="msapplication-config" content="/include/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    
    <script src="/include/js/jquery-3.4.1.min.js" charset="utf-8"></script>
    <?php if ($_SERVER['REQUEST_URI'] == '/pages/notes/') { ?>
        <link rel="stylesheet" href="/_assets/notes/css/style.css">
    <?php } ?>
</head>
