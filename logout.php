<?php
session_start();
require_once 'app/functions.php';
unset($_SESSION['user']);
session_destroy();
redirect("login");
?>