<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $loginPath = strpos($script, '/actions/') !== false ? '../login.php' : 'login.php';
    header('Location: ' . $loginPath);
    exit;
}

$user_id = $_SESSION['user_id'];
