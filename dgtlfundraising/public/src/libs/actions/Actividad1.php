<?php
namespace Libs\Actions;

use Lig\Db\ComponentMysql;

class Actividad1
{
    private $data;
    private $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    private function _scape(&$value)
    {
        $value = str_replace("'","\'",$value);
    }

    private function _get_insert_sql()
    {
        list($titulo,$director,$anio,$pais) = array_values($this->data);
        $this->_scape($titulo);
        $this->_scape($director);
        $this->_scape($pais);
        $anio = (int) $anio;

        $sql = "
        INSERT INTO peliculas (titulo, director, anio, pais)
        VALUES ('$titulo','$director','$anio','$pais')
        ";
        return $sql;
    }

    public function save(){
        $db = new ComponentMysql();
        $sql = $this->_get_insert_sql();
        print_r($sql);
        $r = $db->exec($sql);
        print_r($r);
    }

    public function get_errors()
    {

    }
}