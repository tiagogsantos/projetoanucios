<?php
require 'pages/header.php'; ?>

<?php
require 'classes/anuncios.class.php';
require_once 'classes/Usuarios.class.php';
$a = new Anuncios();
$u = new Usuarios();

$id = addslashes($_GET['id']);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $info = $a->getAnuncio($id);
} else {
    header("Location: index.php");
}

?>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-4">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <?php foreach ($info['fotos'] as $key => $foto): ?>
                            <div class="carousel-item <?php echo ($key == '0') ? 'active' : ''; ?> ">
                                <img src="assets/images/anuncios/<?php echo $foto['url']; ?>">
                            </div>

                        <?php endforeach; ?>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-sm-8">
                Nome do produto: <?php echo $info['titulo'];  ?> <br/>
                Categoria: <?php echo $info['categoria']; ?> <br/>
                Preço: R$ <?php echo number_format($info['valor'], 2, '.', ',') ?><br/><br/>
                Descriçao: <?php echo $info['descricao']; ?> <br/>
                Telefone: <?php echo $info['telefone']; ?>
            </div>
        </div>
    </div>




<?php
require 'pages/footer.php';
?>