<?php

// Fichero de configuración
define("BASE_URL", "http://localhost:8080");

return [
    "bd" => [
        "dsn" => "mysql:dbname=bd_productos;host=localhost",
        //eaf
        "dsn" => "mysql:dbname=bd_productos;host=cont-mariadb-univ;",
        "username" => "root",
        "password" => "1234",
    ],
];