<?php

if (!function_exists("protect")) {
    function protect($admin)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        // Verifica se a sessão está iniciada
        if (!isset($_SESSION['id'])) {
            header("Location: logout.php");
            exit();
        }

        // Verifica se é uma página administrativa
        if ($admin == 1 && (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1)) {
            header("Location: logout.php");
            exit();
        }
    }
}
