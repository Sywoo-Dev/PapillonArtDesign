<?php
session_start();
session_unset();
session_destroy();
ob_start();
header("Location: /login.php");
ob_end_flush();
exit();
?>