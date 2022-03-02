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
            <h3>
              <a class="link" href="/">Productos</a>
            </h3>
            <?php
            if ($producto = ($models["producto"] ?? null)) :
                $id = $producto->getId();
                $error = ($models["error"] ?? "");
                $categorias = $models["categorias"];
            ?>
                <h3>Producto: <?= ( $id ?: "Nuevo" ) ?></h3>

                <form class="form" method="POST" enctype="multipart/form-data">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlentities($error) ?></div>
                    <?php endif; ?>
                    <input type="hidden" name="id" value="<?= $producto->getId() ?>" />
                    <input type="hidden" name="action" value="save" />
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input class="form-control" autofocus maxlength="162" type="text" id="nombre" name="nombre" value="<?= htmlentities( $producto->getNombre() ) ?>" />
                    </div>
                    <div class="form-group">
                        <label for="categoria" class="control-label">Categoría</label>
                        <select id="categoria" name="categoria_id" class="form-control">
                          <?
                          $categoriadId = $producto->getCategoria() ? $producto->getCategoria()->getId() : "";
                          $options = [
                              "<option value=\"\">Seleccione una opción</option>"
                          ];
                          foreach ($categorias as $categoria) {
                              $id = $categoria->getId();
                              $text = htmlentities($categoria->getNombre())." - {$id}";
                              $selected = $categoriadId === $id ? "selected": "";
                              $options[] = "<option value=\"$id\" $selected>$text</option>";
                          }
                          echo implode("\n",$options);
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción</label>
                        <textarea class="form-control" maxlength="258" id="descripcion" name="descripcion"><?= htmlentities( $producto->getDescripcion() ) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagen" class="control-label">Imagen</label>
<!--
@eaf solo permito la seleccion de jpg y png
-->
                        <input class="form-control" id="imagen" name="imagen" type="file" accept="image/png, image/jpeg, image/jpeg" />
                      <?php
                      if ($producto->getImagen()):
                        $id = $producto->getId();
                        $urlImagen = "/productos/{$id}?image=1";
                      ?>
                        <img src="<?=$urlImagen?>"/>
                        <button type="button" class="btn btn-danger" onclick="deleteConfirm(`/productos/<?=$id?>/eliminar-imagen`)">
                          Eliminar imagen
                        </button>
                      <?
                      endif;
                      ?>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            <?php endif; ?>
        </div>
        <?include("js-modal.php")?>
    </body>
</html>