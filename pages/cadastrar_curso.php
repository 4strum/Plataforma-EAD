<?php
include("lib/conexao.php");
include("lib/enviar_arquivo.php");
include('lib/protect.php');
protect(1);

if (isset($_POST['enviar'])) {
    $titulo = $mysqli->escape_string($_POST['titulo']);
    $descricao_curta = $mysqli->escape_string($_POST['descricao_curta']);
    $preco =  $mysqli->escape_string($_POST['preco']);
    $conteudo =  $mysqli->escape_string($_POST['conteudo']);

    $erro = array();
    if (empty($titulo)) {
        $erro[] = 'Preencha o campo titulo';
    }
    if (empty($descricao_curta)) {
        $erro[] = 'Preencha o campo descrição curta';
    }
    if (empty($preco)) {
        $erro[] = 'Preencha o campo preço';
    }
    if (empty($conteudo)) {
        $erro[] = 'Preencha o campo conteúdo';
    }
    if (!isset($_FILES) || !isset($_FILES['imagem']) || $_FILE['imagem']['size'] == 0) {
        $erro[] = 'Preencha o campo imagem para o conteúdo';
    }

    if (count($erro) > 0) {
        $deu_certo = enviarArquivo($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);
        if ($deu_certo !== false) {
            $sql_code = "INSERT INTO tb_cursos (titulo, descricao_curta, conteudo, dt_cadastro, preco, imagem) VALUES(
                '$titulo',
                '$descricao_curta',
                '$conteudo',
                NOW(),
                '$preco',
                '$deu_certo')";
            $inserido = $mysqli->query($sql_code) or die($mysqli->error);
            if (!$inserido) {
                $erro[] = 'Erro ao inserir no bando de dados' . $mysqli->error;
            } else {
                die("<script>location.href=\"index.php?=gerenciar_cursos\";</script>");
            }
        } else {
            $erro[] = 'Erro ao enviar o arquivo';
        };
    };
};


?>

<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Cadastrar curso</h4>
                        <span>Preencha as informações e clique em cadastrar</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.php">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Castro de curso</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
</div>
<?php if (isset($erro) && count($erro) > 0) {
?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($erro as $e) {
            echo "<p>$e</p>";
        } ?>
    </div>
<?php
}
?>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Fromulario de cadastro</h5>
                </div>
                <div class="card-block">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="titulo">Titulo</label>
                                    <input name="titulo" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="descricao_curta">Descrição Curta</label>
                                    <input name="descricao_curta" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="imagem">imagem</label>
                                    <input name="imagem" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="preco">Preço</label>
                                    <input name="preco" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="conteudo">Conteudo</label>
                                    <textarea name="conteudo" rows="10" class="form-control"></textarea>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button name="enviar" type="submit" class="btn btn-success btn-round"><i class="ti-save"></i>Salvar</button>
                                <a href="index.php?p=gerenciar_cursos" type="button" class="btn btn-primary btn-round float-right"><i class="ti-back-left"></i>Voltar</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>