<?php
session_start();
session_destroy();
header("Location: /pdv/mvc/app/app_login.php");
exit();
?>