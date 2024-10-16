<?php

$host = "localhost";
$user = "root";
$pass = "";
$bd = "ead_escola";

$mysqli = new mysqli($host, $user, $pass, $bd);

if($mysqli->connect_error) {
    echo "Falha na conexão do bando de dados";
    exit();
}