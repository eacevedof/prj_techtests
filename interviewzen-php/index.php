<?php
function some_function($param)
{}

$db = mysqli_connect();
try {
    echo "trying\n\n";
    $e = some_function($db);

}
catch (\Exception $err){
    echo "EXCEPTION error:".$err->getMessage();
    //die();
}
finally {
    echo "closing\n\n";
    mysqli_close($db);
}
echo "- END -";

/*
- si la funcion some_function some_function está definida:
    - y hay un catch, se ejecut mysql_close()

*/