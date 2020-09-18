<?php
include("src/libs/bootstrap.php");


$sql = "
CREATE TABLE `peliculas_2` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `director` varchar(255) NOT NULL,
  `anio` int(4) DEFAULT NULL,
  `pais` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
";

$db = new \Lig\Db\ComponentMysql();
$db->exec($sql);
