<?php require 'config.php'; ?>
<?php require 'helper/functions.php'; ?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Classificados</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Classificados</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])): ?>
                <li class="nav-item"><a class="nav-link" href="meus-anuncios.php">
                        <?php
                        require 'classes/Usuarios.class.php';
                        $u = new Usuarios();
                        $nomeUsuario = $u->Logado();
                        $infoid = $u->UserID();

                        if (isset($infoid) && !empty($infoid)) {
                            echo "Bem-vindo de volta - " .$nomeUsuario['nome'];
                        } else {
                            echo '';
                        }

                        ?> </a></li>
                <li class="nav-item"><a class="nav-link" href="meus-anuncios.php">Meus anuncios </a></li>
                <li class="nav-item"><a class="nav-link" href="editar-cadastro.php?id=<?php echo $infoid['id']; ?>">Perfil </a></li>
                <li class="nav-item"><a class="nav-link" href="sair.php">Sair</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastra-se </a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>