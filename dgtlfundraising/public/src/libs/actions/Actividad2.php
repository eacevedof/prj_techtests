<?php
namespace Libs\Actions;

use Lig\Db\ComponentMysql;

class Actividad2
{
    private function _get_select_sql()
    {
        $sql = "
        SELECT * 
        FROM peliculas
        WHERE 1
        ORDER BY titulo
        ";
        return $sql;
    }

    public function get_peliculas()
    {
        $sql = $this->_get_select_sql();
        $r = (new ComponentMysql())->query($sql);
        return $r;
    }
}