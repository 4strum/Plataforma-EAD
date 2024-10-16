<?php
include("lib/conexao.php");
include('lib/protect.php');
protect(1);

$sql_relatorios = "SELECT r.id_relatorio, u.nome, c.titulo, r.data_compra, r.valor FROM relatorio r, usuario u, tb_cursos c WHERE r.id_usuario = u.id_usuario AND r.id_curso = c.id_curso";
$sql_query = $mysqli->query($sql_relatorios) or die($mysqli->error);
$num_relatorios = $sql_query->num_rows;


?>
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Relatorios</h4>
                        <span>Vizualize os gastos do usuario dentro do sistema</span>
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
                        <li class="breadcrumb-item"><a href="#!">Gerenciar Usuarios</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Relatorios</h5>
                        <span></span>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Usuario</th>
                                        <th>Curso</th>
                                        <th>Data</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($num_relatorios == 0) { ?>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Nenhum relatorios</td>
                                        </tr>
                                        <?php } else {
                                        while ($relatorios = $sql_query->fetch_assoc()) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $relatorios['id_relatorio'] ?></th>
                                                <th scope="row"><?php echo $relatorios['nome'] ?></th>
                                                <th scope="row"><?php echo $relatorios['titulo'] ?></th>
                                                <th scope="row"><?php echo date('d/m/Y', 'H:i', strtotime($relatorios['data_compra'])) ?></th>
                                                <td> <?php echo number_format($relatorios['valor'], 2, ',','.') ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>