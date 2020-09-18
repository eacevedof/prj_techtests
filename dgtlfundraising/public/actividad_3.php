<?php
//http://actividades.dgtlfundraising.com/eduardoacevedo/actividad_3.php
include("src/libs/bootstrap.php");

include("src/layout/layout-top.php");
?>
<main class="container">
<h2>Actividad 3 - Calculadora</h2>
<?php
$numero1 = 10;
$numero2 = 5;
(new \Libs\Actions\Calculadora)->get($numero1, $numero2);
?>
</main>
<?php
include("src/layout/layout-bottom.php");
?>


