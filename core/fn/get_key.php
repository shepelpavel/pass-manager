<?php
session_start();
echo $_SESSION['decryptor'];
session_write_close();
return;
?>
