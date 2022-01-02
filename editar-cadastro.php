<?php require 'pages/header.php'; ?>

<?php

/*
 * Verificando se estou logado, caso contrario nao posso editar um anuncio
 */
if (empty($_SESSION['cLogin'])) {
    ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Para editar um anuncio, voce deve estar logado.',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Fazer Login'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'login.php';
            } else if (result.isDismissed) {
                window.location.href = 'index.php';
            }
        })
    </script>
    <?php
    exit;
}

require_once 'classes/Usuarios.class.php';
$u = new Usuarios();

if (isset($_POST['nome']) && !empty($_POST['nome']) && !empty($_POST['email'])
    && ($_POST['senha']) && ($_POST['telefone'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = $_POST['senha'];
    $telefone = addslashes($_POST['telefone']);

    $u->editarUsuario($nome, $email, $senha, $telefone, $_GET['id']);

    ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Seu perfil foi alterado com sucesso.',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'meus-anuncios.php';
            }
        });
    </script>
    <?php

}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $info = $u->UserID ($_GET['id']);
}

?>

<div class="container mt-4">
    <h3>Edite seu cadastro e mantenha seu cadastro atualizado</h3>
    <form method="post" action="">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" value="<?php echo $info['nome']; ?>">
        </div>
        <div class="form-group">
            <label>E-mail:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $info['email']; ?>">
        </div>
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha" class="form-control" value="<?php echo $info['senha']; ?>">
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone" class="form-control" value="<?php echo masc_tel($info['telefone']);  ?>">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">Editar cadastro</button>
        </div>

    </form>
</div>

<?php require 'pages/footer.php'; ?>