<?php
//http://actividades.dgtlfundraising.com/eduardoacevedo/actividad_3.php
include("src/libs/bootstrap.php");

include("src/layout/layout-top.php");

$numero1 = 10;
$numero2 = 5;
$calculadora = new \Libs\Actions\Calculadora();
$calculadora->get($numero1, $numero2);

include("src/layout/layout-bottom.php");
?>


