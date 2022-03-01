<?php
namespace controllers;

use models\Producto;

/**
 * Controlador.
 * 
 * @author obarcia
 */
class Site
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
        return $this->$defaultAction;
    }
    /**
     * Rederizar la vista.
     * @param string $view Nombre de la vista.
     * @param array $models Listado de modelos.
     */
    protected function renderView( $view, $models = [] )
    {
        include( __DIR__ . "/../views/" .$view );
    }
    /**
     * Página principal.
     */
    public function actionIndex()
    {
        $productos = Producto::findAll();
        
        $this->renderView( "index.php", [ "productos" => $productos ] );
    }
    /**
     * Vista de un producto.
     */
    public function actionProductos()
    {
        if ( !empty( $_GET[ "id" ] ) ) {
            $producto = Producto::findOne( $_GET[ "id" ] );
        }
        
        $method = ( !empty( $_GET[ "method" ] ) ? $_GET[ "method" ] : "" );
        
        if ( $method == "delete" ) {
            // Eliminar el producto
            if ( !empty( $producto ) ) {
                $producto->delete();
                
                header( "Location: /" );
            } else {
                throw new \Excetion( "Producto no encontrado." );
            }
        } else {
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
                        $producto->setNombre( $_POST[ "nombre" ] );
                        Producto::setDescripcion( $_POST[ "descripcion" ] );
                        if ( !empty( $_FILES[ "imagen" ][ "tmp_name" ] ) && in_array( $_FILES[ "imagen" ][ "type" ], [ "image/jpg", "image/jpeg", "image/png" ] ) ) {
                            $producto->setImagen( base64_encode( file_get_contents( $_FILES[ "imagen" ][ "tmp_name" ] ) ) );
                        }
                        if ( $producto->save() ) {
                            header( "Location: /" );
                        } else {
                            $this->renderView( "producto.php", [ "producto" => $producto, "error" => "No se pudo guardar el registro." ] );
                        }
                    } else {
                        $this->renderView( "producto.php", [ "producto" => $producto ] );
                    }
                } else {
                    throw new \Excetion( "Producto no encontrado." );
                }

                return;
            }
        }
        
        
        new \Exception( "Producto not found." );
    }
    /**
     * Exportar el XML con los productos.
     */
    public function actionXml()
    {
        $content = Producto::exportXML();
        
        header( 'Content-Description: File Transfer');
        header( 'Content-Type: application/xml' );
        header( 'Content-Disposition: attachment; filename=productos.xml' ); 
        header( 'Content-Transfer-Encoding: binary');
        header( 'Connection: Keep-Alive');
        header( 'Expires: 0');
        header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header( 'Pragma: public' );
        header( 'Content-Length: '.strlen( $content ) );
        echo $content;
        exit;
    }
}