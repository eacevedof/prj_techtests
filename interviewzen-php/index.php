<?php
//function some_function($param){}

$db = mysqli_connect();
try {
    echo "trying\n\n";
    $e = some_function($db);

}
catch (\Exception $err){
    echo "EXCEPTION error:".$err->getMessage();
    die("catch");
}
finally {
    echo "closing\n\n";
    mysqli_close($db);
}
echo "- END -";

/*
- si la funcion some_function some_function está definida:
    - y hay un catch, nunca entra por catch. pasa a finally
    - si no hay un catch, pasa a finally

Warnings:
Warning: mysqli_connect(): (HY000/2002): No such file or director
Warning: mysqli_close() expects parameter 1 to be mysqli, bool given in

*/