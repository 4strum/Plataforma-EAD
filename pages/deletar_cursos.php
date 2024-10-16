<?php
include('lib/protect.php');
protect(1);
include('lib/conexao.php');
$id = intval($_GET['id_curso']);

$mysql_query = $mysqli->query("SELECT imagem FROM tb_cursos WHERE id_curso = '$id'") or die($mysqli->error);
$cursos =$mysql_query->fetch_assoc();

if(unlink($cursos['imagem'])){
    $mysqli->query("DELETE FROM tb_cursos WHERE id_curso = '$id'") or die($mysqli->error); 
   
} 

die("<script>location.href=\"index.php?p=gerenciar_cursos\"</script>");