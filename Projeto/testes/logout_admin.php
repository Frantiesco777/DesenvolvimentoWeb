<?php
session_start();
unset($_SESSION['admin']);
session_destroy();
header("Location: login_admin.php");
exit;
