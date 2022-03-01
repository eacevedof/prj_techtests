<?php
namespace models;

use models\api\ActiveRecord;


/**
 * Clase producto.
 * 
 * @author obarcia
 */
final class Producto extends Base
{
    /**
     * Contenido de la imagen en Base64.
     * @var string
     */
    private $imagen;

    private $categoria_id;

    private $categoria;

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
    public function getCategoria()
    {
        if (!$this->categoria_id) return null;
        $this->categoria = Categoria::findOne($this->categoria_id);
        return $this->categoria;
    }

    public function setCategoria( $categoria )
    {
        $this->categoria = $categoria;
        $this->categoria_id = $categoria->getId();
    }

    /**
     * Validar el producto.
     * @return boolean true si la validación es correcta, false en caso contrario.
     */
    public function validate()
    {
        //el nombre es olbigatorio siempre
        if (!trim($this->nombre)) return false;

        //Nombre: máximo 160 caracteres en UTF‐8
        if (strlen(utf8_encode($this->nombre))>160) return false;

        //Descripción: máximo 258 caracteres en UTF‐8
        if (strlen(utf8_encode($this->descripcion))>258) return false;

        return true;
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
                $urlImagen = $producto->getImagen() ? BASE_URL."/productos/{$producto->getId()}?image=1": "";
                $xml->writeElement("imagen", $urlImagen);
            $xml->endElement();
        }
        $xml->endElement();
        return $xml->outputMemory();
    }

    public function exportEntityInXml()
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString("	");
        $xml->startDocument("1.0", "UTF-8");
        $xml->startElement("producto");
            $xml->writeAttribute("id", $this->getId());
            $xml->writeElement("nombre", $this->getNombre());
            $xml->writeElement("descripcion", $this->getDescripcion());
            $urlImagen = $this->getImagen() ? BASE_URL."/productos/{$this->getId()}?image=1": "";
            $xml->writeElement("imagen", $urlImagen);
        $xml->endElement();
        return $xml->outputMemory();
    }

    public function eliminarImagen()
    {
        if (!$this->id) return false;
        $tableName = self::getTablename();
        $stmt = self::getDb()->prepare( "UPDATE {$tableName} SET imagen = :imagen WHERE id = :id" );
        $params[ "id" ] = $this->id;
        $params[ "imagen" ] = null;
        return $stmt->execute($params);
    }
}