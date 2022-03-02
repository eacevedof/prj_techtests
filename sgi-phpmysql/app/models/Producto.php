<?php
namespace models;

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

    /**
     * Nombre de la tabla.
     * @return string Nombre de la tabla.
     */
    public static function getTablename() { return "Productos_01"; }

    // ***************************************************
    // GETTER & SETTER
    // ***************************************************
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre( $nombre )
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getImagen()
    {
        return $this->imagen;
    }
    public function setImagen($imagen)
    {
        //@eaf doble dolar
        $this->imagen = $imagen;
        return $this;
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
        return $this;
    }

    public function setCategoriaId($categoriaId)
    {
        $this->categoria_id = $categoriaId;
        $this->categoria = Categoria::findOne($categoriaId);
        return $this;
    }

    /**
     * Validar el producto.
     * @return boolean true si la validación es correcta, false en caso contrario.
     */
    protected function validate()
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
     * Guardar el registro.
     * @return boolean true si la operación fué correcta, false en caso contrario.
     */
    public function save()
    {
        if (!$this->validate()) return false;

        $table = static::getTablename();
        $query = (!$id = $this->id)
            ? "INSERT INTO {$table} (nombre, descripcion, imagen, categoria_id) 
               VALUES (:nombre, :descripcion, :imagen, :categoria_id)"

            : "UPDATE {$table} 
               SET nombre = :nombre, descripcion = :descripcion, imagen = :imagen, categoria_id = :categoria_id 
               WHERE id = :id";

        $params = [];
        if ($id) $params["id"] = $id;
        $stmt = self::getDb()->prepare($query);

        $params["nombre"] = $this->nombre;
        $params["descripcion"] = $this->descripcion;
        $params["imagen"] = $this->imagen;
        $params["categoria_id"] = $this->categoria_id;

        //d($query);d($params);
        if (!$stmt->execute($params)) return false;

        if (!$id) $this->id = self::getDb()->lastInsertId();
        return true;
    }

    public static function findOne($id)
    {
        if (!$object = parent::findOne($id)) return null;

        $producto = new Producto();
        $producto->setId($object->id)
            ->setNombre($object->nombre)
            ->setDescripcion($object->descripcion)
            ->setImagen($object->imagen)
            ->setCategoriaId($object->categoria_id)
        ;

        return $producto;
    }

    public static function findAll()
    {
        if (!$result = parent::findAll()) return [];
        $list = [];
        foreach ($result as $object) {
            $producto = new Producto();
            $producto->setId($object->id)
                ->setNombre($object->nombre)
                ->setDescripcion($object->descripcion)
                ->setImagen($object->imagen)
                ->setCategoriaId($object->categoria_id)
            ;
            $list[] = $producto;
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