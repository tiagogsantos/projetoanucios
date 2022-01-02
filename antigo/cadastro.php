<?php require 'pages/header.php'; ?>

<div class="container mt-3">
    <h1>Cadastra-se e obtenha o melhor MarketPlace de Sao Paulo</h1>

    <?php
        require 'classes/Usuarios.class.php';

        $usuario = new Usuarios();
        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = ($_POST['senha']);
            $telefone = addslashes($_POST['telefone']);

            // verificando se meus campos nao estao vazios
            if(!empty($nome) && !empty($email) && !empty($senha)) {
                if($usuario->cadastrar($nome, $email, $senha, $telefone)) {
                    ?>
                    <div class="alert alert-success">
                        <strong>Cadastro realizado com sucesso!</strong>
                        <a class="alert-link" href="login.php">Faça o Login</a>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-warning">
                        <strong>Este usuario ja existe</strong>
                        <a class="alert-link" href="login.php">Faça o Login</a>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="alert alert-warning">
                    Preencha todos os campos!
                </div>
                <?php
            }
        }
    ?>

    <form method="post" action="">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" placeholder="Digite seu nome">
        </div>
        <div class="form-group">
            <label>E-mail:</label>
            <input type="email" name="email" class="form-control" placeholder="Digite o seu e-mail">
        </div>
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha" class="form-control" placeholder="Digite a sua senha">
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone" class="form-control" placeholder="Digite a sua telefone">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </form>
</div>

<?php require 'pages/footer.php'; ?>
