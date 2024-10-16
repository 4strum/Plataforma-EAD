<?php
include("lib/conexao.php");
include('lib/protect.php');
protect(1);

$sql_usuario = "SELECT * FROM usuario";
$sql_query = $mysqli->query($sql_usuario) or die($mysqli->error);
$num_usuario = $sql_query->num_rows;


?>
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Gerenciar Usuarios</h4>
                        <span>Gerenciar os Usuarios cadastrados no sistema</span>
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
                        <h5>Todos os usuarios</h5>
                        <span><a href="index.php?p=cadastrar_usuarios">Clique aqui</a> para cadastrar um novo usuario</span>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Créditos</th>
                                        <th>Data de cadastro</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($num_usuario == 0) { ?>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Nenhum usuario cadastrado</td>
                                        </tr>
                                        <?php } else {
                                        while ($usuario = $sql_query->fetch_assoc()) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $usuario['id_usuario']?></th>
                                                <th scope="row"><?php echo $usuario['nome']?></th>
                                                <th scope="row"><?php echo $usuario['email']?></th>
                                                <th scope="row"><?php echo $usuario['email']?></th>
                                                <th scope="row"><?php echo $usuario['dt_cadastro']?></th>

                                                <td><a href="index.php?p=editar_usuario&id_usuario=<?php echo $usuario['id_usuario']?>">Editar</a> | <a href="index.php?p=deletar_usuario&id_usuario=<?php echo $usuario['id_usuario']?>">Deletar</a></td>
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