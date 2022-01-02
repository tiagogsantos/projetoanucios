<?php require 'pages/header.php'; ?>

<?php

if (empty($_SESSION['cLogin'])) {
    ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Para ver seus anuncios e necessario estar logado.',
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
        });
    </script>
<?php
}

?>

<div class="container mt-4">
    <h1>Meus Anuncios</h1>

    <a href="adicionar-anuncio.php">
        <button class="btn btn-primary" type="button">Adicionar anuncio</button>
    </a>
    <table class="table table-striped text-center mt-3">
        <thead>
        <tr>
            <th>Foto</th>
            <th>Titulo</th>
            <th>Valor</th>
            <th>Açoes</th>
        </tr>
        </thead>

        <?php
        require 'classes/anuncios.class.php';
        $a = new Anuncios();
        $anuncios = $a->getMeusAnuncios();

        foreach ($anuncios as $anuncio): ?>

            <tr>
                <td>
                    <?php if(!empty($anuncio['url'])): ?>
                    <img class="foto_item" src="assets/images/anuncios/<?php echo $anuncio['url']; ?>">
                    <?php else: ?>
                    <img src="assets/images/image-padrao.png" width="50">
                </td>
                <?php endif; ?>

                <td class="align-middle"><?php echo $anuncio['titulo']; ?></td>
                <td class="align-middle">R$ <?php echo number_format($anuncio['valor'], 2, ',', '.'); ?></td>
                <td class="align-middle"><a href="editar-anuncio.php?id=<?php echo $anuncio['id']; ?>"> <button class="btn btn-warning">Editar</button> </a>
                    <a href="excluir-anuncio.php?id=<?php echo $anuncio['id']; ?>"> <button class="btn btn-danger">Excluir</button></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require 'pages/footer.php'; ?>
