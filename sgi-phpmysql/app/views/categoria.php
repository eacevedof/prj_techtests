<html>
    <head>
        <meta charset="UTF-8">
        <title>Categorías</title>
    <?
    include("assets.php");
    ?>
    </head>
    <body>
        <div class="container">
            <h3>
              <a class="link" href="/">Categorías</a>
            </h3>
            <?php if (!empty( $models["categoria"])) : ?>
                <?php
                $id = $models["categoria"]->getId();
                ?>
                <h3>Categoría: <?= ( !empty( $id ) ? $id : "Nuevo" ) ?></h3>

                <form class="form" method="POST" enctype="multipart/form-data">
                    <?php if ( !empty( $models["error"] ) ) : ?>
                        <div class="alert alert-danger"><?= htmlentities( $models["error"] ) ?></div>
                    <?php endif; ?>
                    <input type="hidden" name="id" value="<?= $models["categoria"]->getId() ?>" />
                    <input type="hidden" name="action" value="save" />
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input class="form-control" autofocus maxlength="162" type="text" id="nombre" name="nombre"
                               value="<?= htmlentities( $models["categoria"]->getNombre()) ?>" />
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción</label>
                        <textarea class="form-control" maxlength="258" id="descripcion"
                                  name="descripcion"><?= htmlentities( $models["categoria"]->getDescripcion() ) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            <?php endif; ?>
        </div>
        <?include("js-modal.php")?>
    </body>
</html>