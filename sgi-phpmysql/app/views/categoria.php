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
            <h2>
              <a class="link" href="/categorias">Categorías</a>
            </h2>
            <?php
            if ($categoria = ($models["categoria"] ?? null)) :
                $id = $categoria->getId();
                $error = ($models["error"] ?? "")
            ?>
                <h3>Categoría: <?=$id ? "" : "Nueva" ?></h3>
                <form class="form" method="post">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlentities($error) ?></div>
                    <?php endif; ?>
                    <input type="hidden" name="id" value="<?= $categoria->getId() ?>" />
                    <input type="hidden" name="action" value="save" />
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input class="form-control" autofocus maxlength="162" type="text" id="nombre" name="nombre"
                               value="<?= htmlentities( $categoria->getNombre()) ?>" />
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción</label>
                        <textarea class="form-control" maxlength="258" id="descripcion"
                                  name="descripcion"><?= htmlentities( $categoria->getDescripcion() ) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            <?php endif; ?>
        </div>
        <?include("js-modal.php")?>
    </body>
</html>