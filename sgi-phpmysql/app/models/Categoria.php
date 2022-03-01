<?php
namespace models;

use models\api\ActiveRecord;

/**
 * Clase producto.
 * 
 * @author obarcia
 */
class Categoria extends ActiveRecord
{
    /**
     * Identificador.
     * @var integer
     */
    private $id;
    /**
     * Nombre.
     * @var string 
     */
    private $nombre;
    /**
     * Descripción.
     * @var string
     */
    private $descripcion;


    // ***************************************************
    // GETTER & SETTER
    // ***************************************************
    public function getId()
    {
        return $this->id;
    }
    public function setId( $id )
    {
        $this->id = $id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre( $nombre )
    {
        $this->nombre = $nombre;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion( $descripcion )
    {
        $this->descripcion = $descripcion;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function setImagen( $imagen )
    {
        //@eaf doble dolar
        $this->imagen = $imagen;
    }

    /**
     * Validar el producto.
     * @return boolean true si la validación es correcta, false en caso contrario.
     */
    public function validate()
    {
        //Nombre: máximo 160 caracteres en UTF‐8
        if (strlen(utf8_encode($this->nombre))>160) {
            return false;
        }

        //Descripción: máximo 258 caracteres en UTF‐8
        if (strlen(utf8_encode($this->descripcion))>258) {
            return false;
        }

        return true;
    }


    /**
     * Guardar el registro.
     * @return boolean true si la operación fué correcta, false en caso contrario.
     */
    public function save()
    {
        if ( $this->validate() ) {
            $params = [];
            if ( empty( $this->id ) ) {
                $stmt = self::getDb()->prepare( "INSERT INTO ".self::getTablename()." (nombre, descripcion, imagen) VALUES (:nombre, :descripcion, :imagen)" );
            } else {
                $stmt = self::getDb()->prepare( "UPDATE ".self::getTablename()." SET nombre = :nombre, descripcion = :descripcion, imagen = :imagen WHERE id = :id" );
                $params[ "id" ] = $this->id;
            }
            $params[ "nombre" ] = $this->nombre;
            $params[ "descripcion" ] = $this->descripcion;
            $params[ "imagen" ] = $this->imagen;
            if ( $stmt->execute( $params ) ) {
                $this->id = self::getDb()->lastInsertId();

                return true;
            } else {
                return false;
            }
        }
        
        return false;
    }
    /**
     * Eliminar el producto.
     * @return boolean true si la operación fué correcta, false en caso contrario.
     */
    public function delete()
    {
        if ( !empty( $this->id ) ) {
            $stmt = self::getDb()->prepare( "DELETE FROM ".self::getTablename()." WHERE id = :id" );
            $params[ "id" ] = $this->id;
            if ( $stmt->execute( $params ) ) {
                return true;
            } else {
                return false;
            }
        }
    }
    /**
     * Nombre de la tabla.
     * @return string Nombre de la tabla.
     */
    public static function getTablename()
    {
        return "Productos_01";
    }
    /**
     * Obtener un registro.
     * @param integer $id Identificador del registro.
     * @return \models\Categoria Instancia del registro o null si no lo encuentra.
     */
    public static function findOne( $id )
    {
        $stmt = self::getDb()->prepare( "SELECT * FROM ".self::getTablename()." WHERE id = :id" );
        if ( $stmt->execute( [ "id" => $id ] ) ) {
            $result = $stmt->fetch( \PDO::FETCH_OBJ );
            if ( !empty( $result ) ) {
                $p = new Categoria();
                $p->setId( $result->id );
                $p->setNombre( $result->nombre );
                $p->setDescripcion( $result->descripcion );
                $p->setImagen( $result->imagen );

                return $p;
            }
        }
        
        return null;
    }

    /**
     * Buscar todos los productos.
     */
    public static function findAll()
    {
        $list = [];
        
        $stmt = self::getDb()->query( "SELECT * FROM ".self::getTablename()." ORDER BY id" );
        $result = $stmt->fetchAll( \PDO::FETCH_OBJ );
        if ( !empty( $result ) ) {
            foreach ( $result as $r ) {
                $p = new Categoria();
                $p->setId( $r->id );
                $p->setNombre( $r->nombre );
                $p->setDescripcion( $r->descripcion );
                $p->setImagen( $r->imagen );
                
                $list[] = $p;
            }
        }
        
        return $list;
    }

    /**
     * Exportar los productos a XML.
     * @return string XML como string.
     */
    public static function exportXML()
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString("	");
        $xml->startDocument("1.0", "UTF-8");
        $xml->startElement("productos");
        $productos = self::findAll();
        foreach ($productos as $producto) {
            $xml->startElement("producto");
                $xml->writeAttribute("id", $producto->getId());
                $xml->writeElement("nombre", $producto->getNombre());
                $xml->writeElement("descripcion", $producto->getDescripcion());
                $xml->writeElement("imagen", "http://localhost:8080/productos/{$producto->getId()}?image=1");
            $xml->endElement();
        }
        $xml->endElement();
        return $xml->outputMemory();
    }

}