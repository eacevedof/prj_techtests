<?php
//http://actividades.dgtlfundraising.com/eduardoacevedo/actividad_2.php
include("src/libs/bootstrap.php");
$actividad2 = new \Libs\Actions\Actividad2([]);
$r = $actividad2->get_peliculas();


include("src/layout/layout-top.php");
?>
<main class="container">
<h2> Actividad 2 </h2>
<h3>Número total de películas encontradas: <?= count($r); ?></h3>
<table class="table">
    <thead>
        <th>Titulo</th>
        <th>Director</th>
        <th>Año</th>
        <th>País</th>
    </thead>
    <tbody>
<?php
foreach($r as $i => $row):

?>
    <tr>
        <td><?= $row["titulo"]; ?></td>
        <td><?= $row["director"]; ?></td>
        <td><?= $row["anio"]; ?></td>
        <td><?= $row["pais"]; ?></td>
    </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<script>
</script>
</main>
<?php
include("src/layout/layout-bottom.php");
