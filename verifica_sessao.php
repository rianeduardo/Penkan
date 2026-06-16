<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} // Se não tem sessão, inicia uma

if (empty($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
} // Se user_id da sessão for vazio -> 

$user_id = $_SESSION['user_id'];
