<?php
$categorias = ($models["categorias"] ?? []);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Categorias</title>
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
          <a class="btn btn-success" href="/categoria">Nueva categoría</a>
          <? if($categorias): ?>
              <a class="btn btn-primary" href="/categoriasxml" target="_blank">Exportar a XML</a>
          <? endif; ?>
        </h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($categorias):
                    foreach ($models["categorias"] as $categoria ) : 
                ?>
                <tr>
                    <td><?= htmlentities($categoria->getId()) ?></td>
                    <td><?= htmlentities($categoria->getNombre()) ?></td>
                    <td><?= htmlentities($categoria->getDescripcion()) ?></td>
                    <td>
                        <a class="btn btn-primary" href="/categoria/<?= $categoria->getId() ?>">Editar</a>
                        <button type="button" class="btn btn-danger" onclick="deleteConfirm(`/categoria/<?= $categoria->getId() ?>/delete`)">
                          Eliminar
                        </button>
                        <a class="btn btn-dark" href="/categoria/<?= $categoria->getId() ?>/xml">Xml</a>
                    </td>
                </tr>
                <?php 
                    endforeach; 
                else: ?>
                    <tr><td colspan="5">No hay categorias.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?include("js-modal.php")?>
    </body>
</html>