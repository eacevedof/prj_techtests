<?php
try {
    foo();
}
catch (\Exception $e) {
    echo 'EXCEPTION: ' . $e->getMessage();
}

/*
- si una función no está definida no se puede capturar la excepcion con catch
se mostraría:
    Fatal error: Uncaught Error: Call to undefined function foo()
    Error: Call to undefined function foo()
 */