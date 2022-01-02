<?php
require 'pages/header.php'; ?>

<?php
require 'classes/anuncios.class.php';
require_once 'classes/Usuarios.class.php';
require_once 'classes/categorias.class.php';
$a = new Anuncios();
$u = new Usuarios();
$c = new Categorias();

$filtros = array(
        'categoria' => '',
        'preco' => '',
        'estado' => ''
);

if (isset($_GET['filtros'])) {
    $filtros = $_GET['filtros'];
}

$total_anuncios = $a->getTotalAnuncios($filtros);
$total_usuarios = $u->getTotalUsuarios();

// Paginaçao
$p = 1;
if (isset($_GET['p']) && !empty($_GET['p'])) {
    $p = addslashes($_GET['p']);
}

$porPagina = 2;
$total_paginas = ceil($total_anuncios / $porPagina);

$anuncios = $a->getUltimosAnuncios($p, $porPagina, $filtros);
$categorias = $c->getLista();

?>

<div class="container-fluid mt-3">
    <div class="jumbotron">
        <h1>Nos temos home <?php echo $total_anuncios; ?> anuncios.</h1>
        <p>E temos <?php echo $total_usuarios; ?> usuarios cadastrados</p>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <h3>Pesquisa avançada</h3>
            <form method="get">
                <div class="form-group">
                    <label>Categorias:</label>
                    <select class="form-control" name="filtros[categoria]">
                        <option>Selecione uma categoria</option>
                        <?php foreach($categorias as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id']==$filtros['categoria'])?'selected="selected"':''; ?>><?php echo ($cat['nome']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Preço:</label>
                    <select class="form-control" name="filtros[preco]">
                        <option></option>
                        <option value="0-50" <?php echo ($filtros['preco']=='0-50')?'selected="selected"':''; ?>>R$ 0 - 50</option>
                        <option value="51-100" <?php echo ($filtros['preco']=='51-100')?'selected="selected"':''; ?>>R$ 51 - 100</option>
                        <option value="101-200" <?php echo ($filtros['preco']=='101-200')?'selected="selected"':''; ?>>R$ 101 - 200</option>
                        <option value="201-500" <?php echo ($filtros['preco']=='201-500')?'selected="selected"':''; ?>>R$ 201 - 500</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Estado de Conservaçao:</label>
                    <select id="estado" name="filtros[estado]" class="form-control">
                        <option></option>
                        <option value="0" <?php echo ($filtros['estado']=='0')?'selected="selected"':''; ?>>Ruim</option>
                        <option value="1" <?php echo ($filtros['estado']=='1')?'selected="selected"':''; ?>>Bom</option>
                        <option value="2" <?php echo ($filtros['estado']=='2')?'selected="selected"':''; ?>>Ótimo</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>

        <div class="col-sm-9">
            <h3>Ultimos anuncios</h3>
            <table class="table table-striped">
                <tbody>
                    <?php foreach ($anuncios as $anuncio): ?>
                        <tr>
                            <td>
                                <?php if(!empty($anuncio['url'])): ?>
                                    <img class="foto_item" src="assets/images/anuncios/<?php echo $anuncio['url']; ?>">
                                <?php else: ?>
                                    <img src="assets/images/image-padrao.png" width="50">
                            </td>
                            <?php endif; ?>
                            <td class="align-middle"><a href="produto.php?id=<?php echo $anuncio['id']; ?>"><?php echo $anuncio['titulo']; ?></a> <br/> <?php echo $anuncio['categoria']; ?></td>
                            <td class="align-middle">R$ <?php echo number_format($anuncio['valor'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
                <div class="d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <li class="page-item" <?php echo ($p == $i) ? 'active' : '' ?>><a class="page-link" href="index.php?<?php
                            $w = $_GET;
                            $w['p'] = $i;
                            echo http_build_query($w);
                            ?>"><?php echo ($i)?></a> </li>
                    <?php endfor; ?>

                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
                </div>
        </div>
    </div>
</div>

<?php
require 'pages/footer.php';
?>