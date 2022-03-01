<html>
    <head>
        <meta charset="UTF-8">
        <title>Productos</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <h3>Productos <a class="btn btn-success" href="../index.php" target="_blank">Nuevo producto</a> <a class="btn btn-primary" href="../index.php" target="_blank">XML</a></h3>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( !empty( $models[ "productos"  ] ) ) : ?>
                        <?php foreach ( $models[ "productos"  ] as $p ) : ?>
                            <tr>
                                <td><?= htmlentities( $p->getId() ) ?></td>
                                <td><?= htmlentities( $p->getNombre() ) ?></td>
                                <td><?= htmlentities( $p->getDescripcion() ) ?></td>
                                <td><img src="/productos/<?= $p->getId() ?>?image=1" /></td>
                                <td>
                                    <a class="btn btn-primary" href="/productos/<?= $p->getId() ?>">Editar</a>
                                    <a class="btn btn-danger" href="/productos/<?= $p->getId() ?>/delete">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5">No hay productos.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>