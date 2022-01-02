<?php require 'pages/header.php'; ?>

<div class="container mt-3">
    <h1>Login</h1>

    <?php
    require 'classes/Usuarios.class.php';

    $u = new Usuarios();

    // Verificando se existe email ja cadastrado
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = addslashes($_POST['email']);
        $senha = ($_POST['senha']);

        if($u->login($email, $senha)) {
            ?>
                <script type="text/javascript">window.location.href = "./";</script>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <strong>Email e/ou senha errados, tente novamente!</strong>
            </div>
            <?php
        }
    }
    ?>

    <form method="post" action="">
        <div class="form-group">
            <label>E-mail:</label>
            <input type="email" name="email" class="form-control" placeholder="Digite o seu e-mail">
        </div>
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha" class="form-control" placeholder="Digite a sua senha">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Fazer Login</button>
        </div>
    </form>
</div>

<?php require 'pages/footer.php'; ?>
