<?php
//http://actividades.dgtlfundraising.com/eduardoacevedo/actividad_2.php
include("src/libs/bootstrap.php");
$r = (new \Libs\Actions\Actividad2)->get_peliculas();

include("src/layout/layout-top.php");
?>
<style>
.td-border{
    border: 1px solid black !important;
}
.th-bg{
    background-color: #ccc !important;
}
.td-bg{
    background-color: #3ebad8 !important;
}
</style>
<main class="container">
<h2> Actividad 2 </h2>
<h3>Número total de películas encontradas: <?= count($r); ?></h3>
<table class="table">
    <thead>
        <th class="td-border th-bg">Titulo</th>
        <th class="td-border th-bg">Director</th>
        <th class="td-border th-bg">Año</th>
        <th class="td-border th-bg">País</th>
    </thead>
    <tbody>
<?php
foreach($r as $i => $row):
    $bgcolor = "";
    if(($i%2)!==0) $bgcolor = "td-bg";
?>
    <tr>
        <td class="td-border <?=$bgcolor;?>"><?= $row["titulo"]; ?></td>
        <td class="td-border <?=$bgcolor;?>"><?= $row["director"]; ?></td>
        <td class="td-border <?=$bgcolor;?>"><?= $row["anio"]; ?></td>
        <td class="td-border <?=$bgcolor;?>"><?= get_countryname($row["pais"]); ?></td>
    </tr>
<?php
endforeach;
?>
    </tbody>
</table>
</main>
<?php
include("src/layout/layout-bottom.php");
