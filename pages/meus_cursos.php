<?php

if (!isset($_SESSION)) {
    session_start();
}
include('lib/protect.php');
protect(0);

$id_usuario = $_SESSION['id'];
$cursos_query = $mysqli->query("SELECT * FROM tb_cursos WHERE id_curso IN (SELECT id_curso FROM relatorio WHERE id_usuario = '$id_usuario')") or die($mysqli->error);
?>


<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Meus cursos</h4>
                        <span>Esses são os seus cursos adquiridos</span>
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
                        <li class="breadcrumb-item"><a href="#!">Meus cursos</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="page-body">
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
                            <form action="index.php" method="GET">
                                <input type="hidden" name="p" value="acessar">
                                <input type="hidden" name="id" value="<?php echo $curso['id_curso']; ?>">
                                <button type="submit" n class="form-control btn btn-out -dashed btn-primary btn-square">Acessar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>