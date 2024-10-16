<?php
include("lib/conexao.php");
include('lib/protect.php');
protect(1);

$sql_cursos = "SELECT * FROM tb_cursos";
$sql_query = $mysqli->query($sql_cursos) or die($mysqli->error);
$num_curso = $sql_query->num_rows;


?>
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Gerenciar Cursos</h4>
                        <span>Gerenciar os cursos cadastrados no sistema</span>
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
                        <li class="breadcrumb-item"><a href="#!">Gerenciar Cursos</a>
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
                        <h5>Todos os cursos</h5>
                        <span><a href="index.php?p=cadastrar_curso">Clique aqui</a> para cadastrar um novo curso</span>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Imagem</th>
                                        <th>Titulo</th>
                                        <th>Preço</th>
                                        <th>Gerenciar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($num_curso == 0) { ?>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Nenhum curso cadastrado</td>
                                        </tr>
                                        <?php } else {
                                        while ($curso = $sql_query->fetch_assoc()) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $curso['id_curso']?></th>
                                                <td><img src="<?php echo $curso['imagem']?>" height="50" alt=""></td>
                                                <td><?php echo $curso['titulo']?></td>
                                                <td>R$<?php echo number_format($curso['preco'],2,)?></td>
                                                <td><a href="index.php?p=editar_cursos&id_curso=<?php echo $curso['id_curso']?>">Editar</a> | <a href="index.php?p=deletar_cursos&id_curso=<?php echo $curso['id_curso']?>">Deletar</a></td>
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