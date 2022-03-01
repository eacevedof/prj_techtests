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
        if ( $this->validate() ) {
            $params = [];
            if ( empty( $this->id ) ) {
                $stmt = self::getDb()->prepare( "INSERT INTO ".static::getTablename()." (nombre, descripcion) VALUES (:nombre, :descripcion)" );
            } else {
                $stmt = self::getDb()->prepare( "UPDATE ".static::getTablename()." SET nombre = :nombre, descripcion = :descripcion WHERE id = :id" );
                $params[ "id" ] = $this->id;
            }
            $params[ "nombre" ] = $this->nombre;
            $params[ "descripcion" ] = $this->descripcion;
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
            $stmt = self::getDb()->prepare( "DELETE FROM ".static::getTablename()." WHERE id = :id" );
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
    abstract static function getTablename();

    /**
     * Obtener un registro.
     * @param integer $id Identificador del registro.
     * @return \models\Producto Instancia del registro o null si no lo encuentra.
     */
    public static function findOne( $id )
    {
        $stmt = self::getDb()->prepare( "SELECT * FROM ".static::getTablename()." WHERE id = :id" );
        if ( $stmt->execute( [ "id" => $id ] ) ) {
            $result = $stmt->fetch( \PDO::FETCH_OBJ );
            if ( !empty( $result ) ) {
                $p = new Producto();
                $p->setId( $result->id );
                $p->setNombre( $result->nombre );
                $p->setDescripcion( $result->descripcion );
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

        $stmt = self::getDb()->query( "SELECT * FROM ".static::getTablename()." ORDER BY id" );
        $result = $stmt->fetchAll( \PDO::FETCH_OBJ );
        if ( !empty( $result ) ) {
            foreach ( $result as $r ) {
                $p = new Producto();
                $p->setId( $r->id );
                $p->setNombre( $r->nombre );
                $p->setDescripcion( $r->descripcion );
                $list[] = $p;
            }
        }

        return $list;
    }
}