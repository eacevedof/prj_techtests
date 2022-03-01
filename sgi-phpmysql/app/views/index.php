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