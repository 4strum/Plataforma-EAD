<?php
include('lib/protect.php');
protect(1);
include("lib/conexao.php");
include("lib/enviar_arquivo.php");
$id =  $_SESSION['id'];
if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $erro = array();

    if (empty($nome)) {
        $erro[] = "Nome não pode ser vazio";
    }
    if (empty($email)) {
        $erro[] = "preencha o campo email";
    }


    if (count($erro) == 0) {
        $sql_update = "UPDATE usuario 
        SET nome = '$nome', 
        email = '$email'
        WHERE id_usuario = '$id'";

        if(!empty($senha)){
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $sql_update = "UPDATE usuario 
            SET nome = '$nome', 
            email = '$email',  
            senha = '$senha'
            WHERE id_usuario = '$id'";
        }
        $query_update = $mysqli->query($sql_update) or die($mysqli->error);
        if ($query_update) {
            die('<script>location.href="index.php?p=gerenciar_usuarios"</script>');
        }
    };
};


$sql_query_usuarios = $mysqli->query("SELECT * FROM usuario WHERE id_usuario = '$id'") or die($mysqli->error);
$usuarios = $sql_query_usuarios->fetch_assoc();


?>

<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Editar usuario</h4>
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
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input name="nome" value="<?php echo $usuarios['nome']; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" value="<?php echo $usuarios['email'] ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="senha">Senha</label>
                                    <input name="senha" value="<?php echo $usuarios['senha']; ?>" type="text" class="form-control">
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