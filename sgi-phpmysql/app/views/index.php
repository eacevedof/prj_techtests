<html>
    <head>
        <meta charset="UTF-8">
        <title>Productos</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
    <div class="container">
        <h3>
          <a class="link" href="/">Productos</a>
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
                            <td>
                              <?
                              if ($p->getImagen()):
                                $urlImagen = "/productos/{$p->getId()}?image=1";
                              ?>
                              <img src="<?=$urlImagen?>"/>
                              <?
                              endif;
                              ?>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="/productos/<?= $p->getId() ?>">Editar</a>
                                <button type="button" class="btn btn-danger" onclick="deleteConfirm(`/productos/<?= $p->getId() ?>/delete`)">
                                  Eliminar
                                </button>
                                <a class="btn btn-dark" href="/productos/<?= $p->getId() ?>/xml">Xml</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No hay productos.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
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