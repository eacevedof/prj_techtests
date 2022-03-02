<?php
namespace models;

use models\api\ActiveRecord;

abstract class Base extends ActiveRecord
{
    /**
     * Identificador.
     * @var integer
     */
    protected $id;
    /**
     * Nombre.
     * @var string
     */
    protected $nombre;
    /**
     * Descripción.
     * @var string
     */
    protected $descripcion;


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
     * Guardar el registro.
     * @return boolean true si la operación fué correcta, false en caso contrario.
     */
    public function save()
    {
        if (!$this->validate()) return false;

        $table = static::getTablename();
        $query = ($id = $this->id)
                    ? "INSERT INTO {$table} (nombre, descripcion) VALUES (:nombre, :descripcion)"
                    : "UPDATE {$table} SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";

        $params = [];
        if ($id) $params["id"] = $id;
        $stmt = self::getDb()->prepare($query);

        $params["nombre"] = $this->nombre;
        $params["descripcion"] = $this->descripcion;

        if (!$stmt->execute($params)) return false;

        if (!$id) $this->id = self::getDb()->lastInsertId();
        return true;
    }

    /**
     * Eliminar el producto.
     * @return boolean true si la operación fué correcta, false en caso contrario.
     */
    public function delete()
    {
        if (!$this->id) return false;
        $table = static::getTablename();
        $query = "DELETE FROM {$table} WHERE id = :id";
        $stmt = self::getDb()->prepare($query);
        $params[ "id" ] = $this->id;
        return $stmt->execute($params);
    }

    /**
     * Nombre de la tabla.
     * @return string Nombre de la tabla.
     */
    abstract static function getTablename();

    /**
     * Obtener un registro.
     * @param integer $id Identificador del registro.
     * @return \models\Producto Instancia del registro o null si no lo encuentra.
     */
    protected static function findOne($id)
    {
        if (!$id) return null;

        $table = static::getTablename();
        $query = "SELECT * FROM {$table} WHERE id = :id";
        $stmt = self::getDb()->prepare($query);

        if (!$stmt->execute(["id" => $id ])) return null;

        return $stmt->fetch( \PDO::FETCH_OBJ );

        /*
        $p = new Producto();
        $p->setId( $result->id );
        $p->setNombre( $result->nombre );
        $p->setDescripcion( $result->descripcion );
        */

    }

    /**
     * Buscar todos los productos.
     */
    protected static function findAll()
    {
        $table = static::getTablename();
        $query = "SELECT * FROM {$table} ORDER BY id";
        $stmt = self::getDb()->query($query);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
}