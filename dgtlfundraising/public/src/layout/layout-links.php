<?php
$domain="eduardoacevedo/";
if(APP_ENV==="local") $domain = "";

$texts = [
  1 => "Insert", "Listado", "Calculadora"
];
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php
        for($i=1; $i<4; $i++):
        ?>
        <li class="breadcrumb-item"><a href="/<?=$domain; ?>actividad_<?=$i;?>.php"><?=$texts[$i];?></a></li>
        <?php
        endfor;
        ?>
    </ol>
</nav>