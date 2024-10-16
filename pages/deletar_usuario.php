<?php
include('lib/protect.php');
protect(1);
include('lib/conexao.php');
$id = intval($_GET['id_usuario']);

$mysql_query = $mysqli->query("DELETE FROM usuario WHERE id_usuario = '$id'") or die($mysqli->error);
die("<script>location.href=\"index.php?p=gerenciar_usuarios\"</script>");
