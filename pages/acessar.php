<?php
$id = $_GET['id'];
$id_user = $_SESSION['id'];
$sql_query_cursos = $mysqli->query("SELECT * FROM tb_cursos WHERE id_curso = '$id' AND id_curso IN (SELECT id_curso FROM relatorio WHERE id_usuario = '$id_user')") or die($mysqli->error);
$cursos = $sql_query_cursos->fetch_assoc();

?>

<div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="row align-items-end">
                                            <div class="col-lg-6">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <h4><?php echo $cursos['titulo'];?></h4>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="index.php">
                                                                <i class="icofont icofont-home"></i>
                                                            </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="index.php?p=meus_cursos">Meus cursos</a></li>
                                                        <li class="breadcrumb-item"><a href="#!">Visualizar curso</a></li>
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
                                                    <div class="card-block">
                                                        <p>
                                                            <?php echo $cursos['conteudo'];?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>