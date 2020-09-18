<?php
//http://actividades.dgtlfundraising.com/eduardoacevedo/createtable.php
include("src/libs/bootstrap.php");

$sql = "
CREATE TABLE `peliculas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `director` varchar(255) NOT NULL,
  `anio` int(4) DEFAULT NULL,
  `pais` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
";

$db = new \Lig\Db\ComponentMysql();
echo "droping table peliculas \nn";
$db->exec("DROP TABLE IF EXISTS `peliculas`;");
echo "creating table";
$db->exec($sql);
echo "<pre>$sql</pre>";

$sql = "select * from peliculas";
$r = $db->query($sql);
echo "$sql\n<br/>";
var_dump($r);