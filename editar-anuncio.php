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
        });
    </script>
    <?php
    exit;
}

require 'classes/anuncios.class.php';
$a = new Anuncios();

/*
 * Metodo para criar a edicao do meu anuncio
 */
if (isset($_POST['titulo']) && !empty($_POST['titulo']) && !empty($_POST['categoria']) &&
    !empty($_POST['valor']) && !empty($_POST['descricao'])) {
    $titulo = addslashes($_POST['titulo']);
    $categoria = addslashes($_POST['categoria']);
    $valor = addslashes($_POST['valor']);
    $descricao = addslashes($_POST['descricao']);
    $estado = addslashes($_POST['estado']);

    // Se eu tiver a foto a mesma sera exibida, caso contrario considera meu array vazio
    if (isset($_FILES['fotos'])) {
        $fotos = $_FILES['fotos'];
    } else {
        $fotos = array();
    }

    $a->eddAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $_GET['id']);

    ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Seu anuncio foi editado com sucesso.',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'meus-anuncios.php';
            }
        });
    </script>
    <?php
}

/*
 * Se eu tentar alterar algo sem passar o id irei exibir a mensagem de erro
 */
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $info = $a->getAnuncio($_GET['id']);
} else {
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops, deu erro!',
            text: 'Infelizmente o anuncio selecionado nao e valido para ediçao',
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
    <h1>Atualizaçao de anuncios</h1>

    <form method="post" enctype="multipart/form-data" action="">
        <div class="form-group">
            <label>Categoria</label>
            <select name="categoria" id="categoria" class="form-control">
                <?php
                require 'classes/categorias.class.php';
                $c = new Categorias();
                $cats = $c->getLista();

                foreach ($cats as $cat):
                    ?>
                    <option value="<?php echo $cat['id']; ?>" <?php echo($info['id_categoria'] == $cat['id']
                        ? 'selected="selected"' : '') ?>><?php echo $cat['nome']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Titulo</label>
            <input type="text" name="titulo" class="form-control" value="<?php echo $info['titulo']; ?>">
        </div>
        <div class="form-group">
            <label>Valor</label>
            <input type="text" name="valor" class="form-control" value="<?php echo $info['valor']; ?>">
        </div>

        <div class="form-group">
            <label>Descricao</label>
            <textarea name="descricao" class="form-control"><?php echo $info['descricao']; ?></textarea>
        </div>

        <div class="form-group">
            <label>Estado de Conservacao</label>
            <select name="estado" id="estado" class="form-control">
                <option value="1" <?php echo($info['estado'] == 1 ? 'selected="selected"' : '') ?>>Otimo</option>
                <option value="2" <?php echo($info['estado'] == 2 ? 'selected="selected"' : '') ?>>Bom</option>
                <option value="3" <?php echo($info['estado'] == 3 ? 'selected="selected"' : '') ?>>Ruim</option>
            </select>
        </div>

        <div class="form-group">
            <div class="container">
                <label>Fotos do anuncio:</label>
                <input type="file" name="fotos[]" multiple/>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <?php foreach($info['fotos'] as $foto): ?>
                    <div class="col-sm-4">
                        <img class="img-thumbnail foto_item mt-2" src="assets/images/anuncios/<?php echo $foto['url']; ?>">
                        <br/>
                        <a href="excluir-foto.php?id=<?php echo $foto['id']; ?>" class="btn btn-default">Excluir Imagem</a>
                    </div>
                <?php endforeach; ?>

            </div>

            <button id="enviar" class="btn btn-primary mt-5 my-4" type="submit">Atualizar Anuncio</button>
        </div>
</div>

</form>

<?php require 'pages/footer.php'; ?>
