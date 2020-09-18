<?php
//http://actividades.dgtlfundraising.com/eduardoacevedo/cleantest.php
include("src/libs/bootstrap.php");
$db = new \Lig\Db\ComponentMysql();
$sql = "DELETE FROM peliculas WHERE titulo='' OR titulo LIKE '%prueba%' ";
$r = $db->exec($sql);
echo "$sql\n<br/>";
var_dump($r);