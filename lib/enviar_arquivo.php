<?php
function enviarArquivo($error, $size, $name, $tmp_name){
    include('lib/conexao.php');

    if($error)
    die("Falha ao enviar o arquivo");

    if($size > 2097152)
    die("O arquivo ultrapassa o limite de 2MB");

    $pasta = "upload/";
    $nomeDoArquivo = $name;
    $novoNomeDoArquivo = uniqid();
    $extansao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    if($extansao != "jpg" && $extansao != "png" && $extansao != "gif")
        die("Tipo de arquivo invalido");
    
    $path = $pasta . $novoNomeDoArquivo . "." . $extansao;
    $deu_certo = move_uploaded_file($tmp_name, $path);
    if($deu_certo)
        return $path;
    else
        return false;
}
