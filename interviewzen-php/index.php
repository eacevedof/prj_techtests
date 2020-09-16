<?php
function some_function($param){}

$db = mysqli_connect();
try {
    echo "trying\n\n<br/>";
    $e = some_function($db);

}
catch (\Exception $err){
    echo "<br/>EXCEPTION error:".$err->getMessage()."<br/>";
}
finally {
    echo "finally closing\n\n";
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

- si la función no está definida pero entra por finally
Fatal error: Uncaught Error: Call to undefined function some_function()
Error: Call to undefined function some_function()

En conclusion siempre entra por finally
*/