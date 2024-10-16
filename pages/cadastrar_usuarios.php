<?php
include("lib/conexao.php");
include("lib/enviar_arquivo.php");
include('lib/protect.php');
protect(1);

if (isset($_POST['enviar'])) {
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
    $credito = $mysqli->real_escape_string($_POST['credito']);
    $admin = $mysqli->real_escape_string($_POST['tipo']);

    $erro = array();

    if (empty($nome)) {
        $erro[] = "Nome não pode ser vazio";
    }
    if (empty($email)) {
        $erro[] = "preencha o campo email";
    }
    if (empty($senha)) {
        $erro[] = "preencha o campo senha";
    }
    if (empty($credito)) {
        $erro[] = "preencha o campo credito";
    }

    if (count($erro) == 0) {
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $sql_insert = "INSERT INTO usuario (nome, email, senha, credito, dt_cadastro, admin) VALUES('$nome', '$email', '$senha', '$credito', NOW(),'$admin')";
        $query_insert = $mysqli->query($sql_insert) or die($mysqli->error);
        if ($query_insert) {
            die('<script>location.href="index.php?p=gerenciar_usuarios"</script>');
        }
    }
}

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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nome">nome</label>
                                    <input name="nome" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="senha">Senha</label>
                                    <input name="senha" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Credito</label>
                                    <input name="credito" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Tipo</label>
                                    <select name="tipo" class="form-control">
                                        <option value="0">Comum</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button name="enviar" type="submit" class="btn btn-success btn-round"><i class="ti-save"></i>Salvar</button>
                                <a href="index.php?p=gerenciar_usuarios" type="button" class="btn btn-primary btn-round float-right"><i class="ti-back-left"></i>Voltar</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>