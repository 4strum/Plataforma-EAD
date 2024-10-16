<?php
if (!isset($_SESSION)) {
    session_start();
}

// Destrói todas as variáveis da sessão
$_SESSION = [];

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header("Location: login.php");
exit(); // Sempre use exit após header para garantir que o script não continue a execução
?>
