<?php

if (!isset($_SESSION)) {
    session_start();
}

$erro = false;
if (isset($_POST['adquirir'])) {

    //verificar se o usuario tem creditos o suficiente para comprar o curso
    $id_user = $_SESSION['id'];
    $sql_query_credito = $mysqli->query("SELECT credito FROM usuario WHERE id_usuario = '$id_user'") or die($mysli->error);
    $usuario = $sql_query_credito->fetch_assoc();

    $creditos_do_usuario = $usuario['credito'];

    $id = intval($_POST['adquirir']);
    $sql_query_curso = $mysqli->query("SELECT preco FROM tb_cursos WHERE id_curso = '$id'") or die($mysli->error);
    $curso = $sql_query_curso->fetch_assoc();

    $preco_curso = $curso['preco'];

    if ($preco_curso > $creditos_do_usuario) {
        $erro = "Você não tem credito o suficiente para comprar este curso!";
    }else{
        $mysqli->query("INSERT INTO relatorio (id_usuario, id_curso, valor, data_compra) VALUES(
            '$id_user',
            '$id',
            '$preco_curso',
            NOW()
        )") or die($mysqli->error);
        $novo_credito = $creditos_do_usuario - $preco_curso;
        $mysqli->query("UPDATE usuario SET credito = $novo_credito WHERE id_usuario = '$id_user'") or die($mysqli->error);
        die("<script>location.href='index.php?p=meus_cursos'</script>");
    }

}

$id_usuario = $_SESSION['id'];
$cursos_query = $mysqli->query("SELECT * FROM tb_cursos WHERE id_curso NOT IN (SELECT id_curso FROM relatorio WHERE id_usuario = '$id_usuario')") or die($mysqli->error);
include('lib/protect.php');
protect(0);
?>

<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Loja de cursos</h4>
                        <span>Adquira nossos cursos com seus creditos</span>
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
                        <li class="breadcrumb-item"><a href="#!">Loja de cursos</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="page-body">
        <div>
            <?php if ($erro !== false) {
                ?>
                <div class="alert alert-danger">
                    <?php echo $erro; ?>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <?php while ($curso = $cursos_query->fetch_assoc()) { ?>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo $curso['titulo']; ?></h5>
                            <span>Seja bem vindo a THE NEW SCHOOL</span>
                        </div>
                        <div class="card-block">
                            <img src="<?php echo $curso['imagem']; ?>" class="img-fluid mb-3">
                            <p>
                                <?php echo $curso['descricao_curta']; ?>
                            </p>
                            <form action="" method="POST">
                                <button type="submit" name="adquirir" value="<?php echo $curso['id_curso']; ?>"
                                    class="form-control btn btn-out -dashed btn-success btn-square">Adquirir por R$
                                    <?php echo number_format($curso['preco'], 2, ',', '.'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>