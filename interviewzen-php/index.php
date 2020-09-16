<?php
$result = "Esta es la fecha de mi cumpleaños 2021/02/01 nací en diciembre";
//$result = "2021/02/01";


//$s1="01"; $s2="07"; $s3="1976";
//$s1="1988"; $s2="11"; $s3="03";

// /i case insensitve
$r = preg_replace("/([0-9]{4})\/([0-9]{2})\/([0-9]{2})/i","$3-$2-$1", $result);
echo "<pre>";
print_r("original: $result");
echo "\n\n";
print_r("cambiado: ".$r);
echo "\n\n";
echo "
Busca en result el patron y lo extrae en las variables ordenadas \$3 \$2 \$1, 1:año, 2:mes, 3:día con estas variables definidas se forma el string de remplazo
haciendo un cambio de posicion de los elementos de la fecha
Si entra 2021/02/01 saldría 02/02/2021
";

