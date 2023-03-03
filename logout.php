<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '_inc/function.php';

unset($_SESSION['user']);

header('Location: index.php');
exit;
?>
