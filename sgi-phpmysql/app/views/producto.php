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
@eaf solo permito la seleccion solo de jpg y png
-->
                        <input class="form-control" id="imagen" name="imagen" type="file" accept="image/png, image/jpeg, image/jpeg" />
                      <?php
                      if ($models["producto"]->getImagen()):
                        $id = $models["producto"]->getId();
                        $urlImagen = "/productos/{$id}?image=1";
                      ?>
                        <img src="<?=$urlImagen?>"/>
                        <button type="button" class="btn btn-danger" onclick="deleteConfirm(`/productos/<?=$id?>/img-remove`)">
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
        <script>
          function deleteConfirm(url){
            Swal.fire({
              title: "¿Deseas continuar con la eliminación?",
              showCancelButton: true,
              cancelButtonText: "Cancelar",
              confirmButtonText: "Continuar",
              confirmButtonColor: "red",
            }).then((result) => {
              if (result.isConfirmed) {
                window.location = url
              }
            })
          }
        </script>
    </body>
</html>