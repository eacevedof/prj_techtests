<html>
    <head>
        <meta charset="UTF-8">
        <title>Productos</title>
      <?
      include("assets.php");
      ?>
    </head>
    <body>
    <div class="container">
        <h2>
          <a class="link" href="/">Productos</a> /
          <a class="link" href="/categorias">Categorias</a>
        </h2>
        <h3>
<!--
@eaf
convierto a friendly url y agrego a productos un enlace para refresh y apunto al metodo principal actionProductos
-->
          <a class="btn btn-success" href="/productos">Nuevo producto</a>
          <a class="btn btn-primary" href="/xml" target="_blank">XML</a>
        </h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (!empty($models["productos"])):
                    foreach ($models["productos"] as $producto ) : 
                ?>
                <tr>
                    <td><?= htmlentities($producto->getId()) ?></td>
                    <td><?= htmlentities($producto->getNombre()) ?></td>
                    <td><?= htmlentities($producto->getDescripcion()) ?></td>
                    <td>
                    <?
                    if ($producto->getImagen()):
                      $urlImagen = "/productos/{$producto->getId()}?image=1";
                    ?>
                    <img src="<?=$urlImagen?>"/>
                    <?
                    endif;
                    ?>
                    </td>
                    <td><?= $producto->getCategoria() ? htmlentities($producto->getCategoria()->getNombre()) : "Sin categoría" ?></td>
                    <td>
                        <a class="btn btn-primary" href="/productos/<?= $producto->getId() ?>">Editar</a>
                        <button type="button" class="btn btn-danger" onclick="deleteConfirm(`/productos/<?= $producto->getId() ?>/delete`)">
                          Eliminar
                        </button>
                        <a class="btn btn-dark" href="/productos/<?= $producto->getId() ?>/xml">Xml</a>
                    </td>
                </tr>
                <?php 
                    endforeach; 
                else: ?>
                    <tr><td colspan="5">No hay productos.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    </body>
</html>