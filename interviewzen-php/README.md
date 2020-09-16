## [Interviewzen - php](https://www.interviewzen.com/interview/56fvshF)
<pre style="margin:0; padding: 0;">
Question 1
¿Qué valor imprime el siguiente código?

$a = array();
if ($a == null) { 
    echo 'verdadero';
} else {
    echo 'falso';
}

- verdadero  [ok]

Question 2
Resultado de $var: $var = true ? '1' : false ? '2' : '3';
- '1' [nok] es '2' tiene trampa. Sería: (true ? '1' : false) ? '2' : '3';

Question 3
¿Que utilidad tiene esta expresión regular?:

preg_replace("/([0-9]{4})\/([0-9]{2})\/([0-9]{2})/i","$3/$2/$1",$result);
- extrae en $result un formato fecha tipo [yyyy,mm,dd]

Question 4
¿Se ejecutará la llamada al método mysqli_close?

$db = mysqli_connect();
try {
    $totalElements = some_function($db);
    return $totalElements;
} finally {
    mysqli_close($db);
}
- si, siempre

Question 5
Qué ocurre al ejecutar este fragmento de código en versiones de PHP 5.x? ¿Y en PHP 7?

Nota: foo() no está definido
<?php

try {
  foo();

} catch (\Exception $e) { echo 'EXCEPTION: ' . $e->getMessage();}
en php 5 saltaria un error del interprete con funcion no definida y en PHP 7 entraria por la excepcion y se mostraría un mensaje de función no definida

Question 6
En PHP, ¿ Para que se usa el operador lógico === ?
- evalua la igualdad por tipo y valor

Question 7
¿Cómo es el funcionamiento de la session en PHP? Explicar un poco el funcionamiento.
- La sesion es un identificador por cliente conectado al servidor de modo que sea identificado como único se usa junto con la gestión de cookies

Question 8
¿Qué son los traits? Explícalo con tus propias palabras, indica algún caso de uso en el que estaría bien aplicarlo y posibles contraindicaciones de usar traits.
- Es una implementación en php que permite emular la multiherencia. Los traits puede que sobrescriban métodos ya existentes. Se usa para extender una funcionalidad sin aplicar herencia.
Yo los uso para gestionar variables de entorno y logs.  Tengo un trait con cada funcionalidad y lo agrego en la clase según la necesidad.

Question 9
¿Qué ocurre al ejecutar el siguiente código?:
<?php
function sum(int $a, int $b)
{
    return $a + $b;
}

$a = 5;
$b = "4";

echo " $a + $b = " . sum($a, $b);
- en php 7 daría un error en el interprete porque se ha definido un tipo entero en b y se esta pasando un string "4"

Question 10
¿Qué son los estándares PSR?
- son en su mayoría estructuras de arquitectura de software que garantizan una uniformidad de interacción con estas ya que se basan en interfaces.  Esto hace posible cambiar ciertas piezas del código por otras siempre y cuando cumplan el stándar

Question 11
Define un servicio en Symfony llamado foo (utiliza el namespace que quieras para la clase Foo) que tenga como dependencia el servicio de Logger de Symfony, y que no se instancie hasta que no se utilice.
<?php
namespace App\Services;

use Symfony\Logger;

class FooService{
    private $logger;
    
    private function _init(){
        if(!$this->logger)
           $this->logger = new Logger();
           
    }
    
    public function log($content)
    {
        $this->_init();
        $this->logger->log($content)
    }
    
    
}

$service = new FooService();
$service->log("some content")

Question 12
Define qué es la compiler pass y un ejemplo de para qué se puede utilizar.
- Candidate skipped question

Question 13
¿Qué problemas tiene el inyectar el container de Symfony como parámetro a una clase de nuestro dominio?
- Se hace un fuerte acoplamiento con la infraestructura y el dominio no debe interactuar directamente por tipo sino por contrato

Question 14
Explica como funciona el late binding en PHP
- Candidate skipped question

Question 15
¿Qué es lo que se almacena en aceleradores de caché como OPcache o APC?
- Se guarda contenido serializado y minificado para su posterior reutilización sin tener que recompilar el contenido.
Emula el contenido estático
</pre>
