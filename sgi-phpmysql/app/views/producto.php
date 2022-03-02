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
            <?php if ( !empty( $models[ "producto" ] ) ) : ?>
                <?php
                $id = $models[ "producto" ]->getId();
                ?>
                <h3>Producto: <?= ( !empty( $id ) ? $id : "Nuevo" ) ?></h3>

                <form class="form" method="POST" enctype="multipart/form-data">
                    <?php if ( !empty( $models[ "error" ] ) ) : ?>
                        <div class="alert alert-danger"><?= htmlentities( $models[ "error" ] ) ?></div>
                    <?php endif; ?>
                    <input type="hidden" name="id" value="<?= $models[ "producto" ]->getId() ?>" />
                    <input type="hidden" name="action" value="save" />
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input class="form-control" autofocus maxlength="162" type="text" id="nombre" name="nombre" value="<?= htmlentities( $models[ "producto" ]->getNombre() ) ?>" />
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción</label>
                        <textarea class="form-control" maxlength="258" id="descripcion" name="descripcion"><?= htmlentities( $models[ "producto" ]->getDescripcion() ) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagen" class="control-label">Imagen</label>
<!--
@eaf solo permito la seleccion de jpg y png
-->
                        <input class="form-control" id="imagen" name="imagen" type="file" accept="image/png, image/jpeg, image/jpeg" />
                      <?php
                      if ($models["producto"]->getImagen()):
                        $id = $models["producto"]->getId();
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