<?php
namespace controllers;

use models\Categoria;
use models\Producto;

/**
 * Controlador.
 * 
 * @author obarcia
 */
final class Site
{
    /**
     * Acción por defecto.
     * @var string
     */
    private $defaultAction = "index";
    
    /**
     * Devuelve la acción por defecto.
     * @return string Acción por defecto.
     */
    public function getDefaultAction()
    {
        //@fix se llamaba con $defaultAction
        return $this->defaultAction;
    }

    /**
     * Rederizar la vista.
     * @param string $view Nombre de la vista.
     * @param array $models Listado de modelos.
     */
    protected function renderView($view, $models = [])
    {
        $dir =  __DIR__;
        include("{$dir}/../views/{$view}");
    }

    /**
     * Página principal.
     */
    public function actionIndex()
    {
        $productos = Producto::findAll();
        $this->renderView( "index.php", ["productos" => $productos]);
    }


    /**
     * Vista de un producto.
     */
    public function actionProductos()
    {
        if ($id = ($_GET[ "id" ] ?? "")) {
            $producto = Producto::findOne($id);
        }

        $method = ( !empty( $_GET[ "method" ] ) ? $_GET[ "method" ] : "" );

        if ( $method == "delete" ) {
            // Eliminar el producto
            if ( !empty( $producto ) ) {
                $producto->delete();

                header( "Location: /" );
            } else {
                //@eaf typo exception
                throw new \Exception( "Producto no encontrado." );
            }
        }
        elseif ( $method == "xml" ) {
            if (!$producto) throw new \Exception( "Producto no encontrado." );
            $this->responseXml($producto->exportEntityInXml());
        }
        elseif ( $method == "eliminar-imagen" ) {
            if (!$producto) throw new \Exception( "Producto no encontrado." );
            if (!$producto->eliminarImagen()) throw new \Exception( "No se ha podido eliminar la imagen" );
            header("Location: /productos/{$id}");
        }
        else {
            $headers = getallheaders();
            if ( in_array( $headers[ "Accept" ], [ "image/jpg", "image/jpeg", "image/png" ] ) || !empty( $_GET[ "image" ] ) ) {
                if ( !empty( $producto ) ) {
                    $imageB64 = $producto->getImagen();
                    if ( !empty( $imageB64 ) ) {
                        $content = base64_decode( $imageB64 );
                    } else {
                        exit;
                    }
                    header( 'Content-Description: File Transfer');
                    header( 'Content-Type: image/png' );
                    header( 'Content-Disposition: attachment; filename=producto'.$producto->getId()."_image.png" );
                    header( 'Content-Transfer-Encoding: binary');
                    header( 'Connection: Keep-Alive');
                    header( 'Expires: 0');
                    header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header( 'Pragma: public' );
                    header( 'Content-Length: '.strlen( $content ) );
                    echo $content;

                    exit;
                }
            } else {
                if ( empty( $producto ) && empty( $_GET[ "id" ] ) ) {
                    $producto = new Producto();
                }

                if ( !empty( $producto ) ) {
                    if ( !empty( $_POST[ "action" ] ) && $_POST[ "action" ] == "save" ) {
                        $producto->setNombre( $_POST[ "nombre" ]);
                        // @eaf no se debe usar el metodo estatico
                        $producto->setDescripcion($_POST[ "descripcion" ]);
                        $producto->setCategoriaId($_POST["categoria_id"]);
                        if ( !empty( $_FILES[ "imagen" ][ "tmp_name" ] ) && in_array( $_FILES[ "imagen" ][ "type" ], [ "image/jpg", "image/jpeg", "image/png" ] ) ) {
                            $producto->setImagen( base64_encode( file_get_contents( $_FILES[ "imagen" ][ "tmp_name" ] ) ) );
                        }
                        //d($_POST);
                        //dd($producto);
                        if ( $producto->save() ) {
                            header( "Location: /" );
                        } else {
                            $this->renderView( "producto.php", [ "producto" => $producto, "error" => "No se pudo guardar el registro." ] );
                        }
                    } else {
                        $this->renderView( "producto.php", ["producto" => $producto, "categorias"=>Categoria::findAll()] );
                    }
                } else {
                    // @eaf typo
                    throw new \Exception( "Producto no encontrado." );
                }

                return;
            }
        }


        new \Exception( "Producto not found." );
    }


    public function actionCategorias()
    {
        $categorias = Categoria::findAll();
        $this->renderView( "categorias.php", ["categorias" => $categorias]);
    }

    public function actionCategoria()
    {
        $categoriaId = (int) trim($_GET[ "id" ] ?? "");
        $method = trim($_GET["method"] ?? "");

        if ($categoriaId && $method) {
            $categoria = Categoria::findOne($categoriaId);
            switch ($method) {
                case "delete":
                    if (!$categoria) throw new \Exception("Categoría no encontrada.");
                    $categoria->delete();
                    header("Location: /categorias");
                break;
                case "xml":
                    $this->responseXml($categoria->exportEntityInXml(), "categoria");
                break;
            }
            return;
        }

        $action = trim($_POST["action"] ?? "");
        $categoria = Categoria::findOne($categoriaId) ?: new Categoria();
        if ($action === "save") {
            $isSaved = $categoria->setNombre(trim($_POST["nombre"] ?? ""))
                ->setDescripcion(trim($_POST["descripcion"] ?? ""))
                ->save();
            if ($isSaved) return header("Location: /categorias");
            $this->renderView("categoria.php", ["categoria"=>$categoria, "error" => "No se pudo guardar el registro."]);
        }

        $this->renderView("categoria.php", ["categoria"=>$categoria]);
    }


    private function responseXml($content, $filename="productos") {
        header( 'Content-Description: File Transfer');
        header( 'Content-Type: application/xml' );
        header( "Content-Disposition: attachment; filename=$filename.xml");
        header( 'Content-Transfer-Encoding: binary');
        header( 'Connection: Keep-Alive');
        header( 'Expires: 0');
        header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header( 'Pragma: public' );
        header( 'Content-Length: '.strlen($content));
        echo $content;
        exit;
    }

    /**
     * Exportar el XML con los productos.
     */
    public function actionXml()
    {
        $content = Producto::exportXML();
        $this->responseXml($content);
    }

    public function actionCategoriasXml()
    {
        $content = Categoria::exportXML();
        $this->responseXml($content, "categorias");
    }
}