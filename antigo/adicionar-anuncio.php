<?php require 'pages/header.php'; ?>

<?php
/*
 * Verificando se o usuario esta logado, caso contrario o mesmo nao pode adicionar anuncio
 */
if (empty($_SESSION['cLogin'])) {
    ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Para adicionar um novo anuncio, voce deve estar logado.',
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

require 'classes/anuncios.class.php';
$a = new Anuncios();

/*
 * Metodo para a criaçao de anuncio
 */
if (isset($_POST['titulo']) && !empty($_POST['titulo']) && !empty($_POST['categoria']) &&
    !empty($_POST['valor']) && !empty($_POST['descricao'])) {
    $titulo = addslashes($_POST['titulo']);
    $categoria = addslashes($_POST['categoria']);
    $valor = addslashes($_POST['valor']);
    $descricao = addslashes($_POST['descricao']);
    $estado = addslashes($_POST['estado']);
    $a->addAnuncio($titulo, $categoria, $valor, $descricao, $estado);

    ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Seu anuncio foi enviado com sucesso.',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'meus-anuncios.php';
            }
        });

    </script>
    <?php
}

?>

<div class="container mt-5">
    <h1>Inserçao de anuncios</h1>

    <form method="post" enctype="multipart/form-data" action="">
        <div class="form-group">
            <label>Categoria</label>
            <select name="categoria" id="categoria" class="form-control">
                <?php
                require 'classes/categorias.class.php';
                /*
                 * Metodo para retornar a minha lista de categorias
                 */
                $c = new Categorias();
                $cats = $c->getLista();

                foreach ($cats as $cat):
                    ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nome']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Titulo</label>
            <input type="text" name="titulo" class="form-control">
        </div>
        <div class="form-group">
            <label>Valor</label>
            <input type="text" name="valor" class="form-control">
        </div>

        <div class="form-group">
            <label>Descricao</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Estado de Conservacao</label>
            <select name="estado" id="estado" class="form-control">
                <option value="1">Otimo</option>
                <option value="2">Bom</option>
                <option value="3">Ruim</option>
            </select>
        </div>

        <button id="enviar" class="btn btn-primary" type="submit">Adicionar</button>

    </form>
</div>

<?php require 'pages/footer.php'; ?>
