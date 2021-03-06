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

- verdadero

Question 2
Resultado de $var: $var = true ? '1' : false ? '2' : '3';
- ~'1' [nok]~ 
- Es '2' tiene trampa. Sería: (true ? '1' : false) ? '2' : '3';

Question 3
¿Que utilidad tiene esta expresión regular?:

preg_replace("/([0-9]{4})\/([0-9]{2})\/([0-9]{2})/i","$3/$2/$1",$result);
- extrae en $result un formato fecha tipo [yyyy,mm,dd] [nok]
- Busca en result el patron y lo extrae en las variables ordenadas \$3 \$2 \$1, 1:año, 2:mes, 3:día con estas variables 
  definidas se forma el string de remplazo haciendo un cambio de posicion de los elementos de la fecha Si entra 
  2021/02/01 saldría 02/02/2021

Question 4
¿Se ejecutará la llamada al método mysqli_close?

$db = mysqli_connect();
try {
    $totalElements = some_function($db);
    return $totalElements;
} finally {
    mysqli_close($db);
}
- si, siempre [ok]
- si la funcion **some_function** está definida:
    - si no hay un catch, pasa a finally
    - y hay un catch, nunca entra por catch. pasa a finally
```
Warnings:
Warning: mysqli_connect(): (HY000/2002): No such file or director
Warning: mysqli_close() expects parameter 1 to be mysqli, bool given in
```
- Si la función no está definida igual pasa por finally
```
Fatal error: Uncaught Error: Call to undefined function some_function()
Error: Call to undefined function some_function()
```
En conclusion siempre entra por finally

Question 5
Qué ocurre al ejecutar este fragmento de código en versiones de PHP 5.x? ¿Y en PHP 7?

Nota: foo() no está definido

try {
  foo();

} 
catch (\Exception $e){ 
    echo 'EXCEPTION: ' . $e->getMessage();
}
```php
//php5
Fatal error:  Call to undefined function foo() in

//php7
Fatal error:  Uncaught Error: Call to undefined function foo() in
```

Question 6
En PHP, ¿ Para que se usa el operador lógico === ?
- evalua la igualdad por tipo y valor [ok]
$r = "9" == 9;
echo "result $r \n\n"; //true
$r = "9" === 9;
echo "result $r \n\n"; //false

Question 7
¿Cómo es el funcionamiento de la session en PHP? Explicar un poco el funcionamiento.
- La sesion es un identificador por cliente conectado al servidor de modo que sea identificado como único se usa junto con la gestión de cookies [ok]
- La sesion en PHP crea un identificador y lo envia al navegador mediante de cookies de sesion. Este id sirve para recuperar los datos de la sesion existente.

Question 8
¿Qué son los traits? Explícalo con tus propias palabras, indica algún caso de uso en el que estaría bien aplicarlo y posibles contraindicaciones de usar traits.
- Es una implementación en php que permite emular la multiherencia. 
- Los traits puede que sobrescriban métodos ya existentes. 
- Se usa para extender una funcionalidad sin aplicar herencia ni composición.
- Caso de uso:
    Tengo una clase que está extendiendo otra y necesito cierta funcionalidad que tengo en otra clase, podría llevar esa funcionalidad a un trait e instanciarla
    en ambas clases 
    
- Conflictos:
    - Si un Trait inserta un método con el mismo nombre de otro trait se produce un error fatal, esto se soluciona con instanceof
    use A, B {
         B::smallTalk insteadof A;
         A::bigTalk insteadof B;
     } 

Question 9
¿Qué ocurre al ejecutar el siguiente código?:
function sum(int $a, int $b)
{
    return $a + $b;
}

$a = 5;
$b = "4";

echo " $a + $b = " . sum($a, $b);
- si se usa declare(stryct_types=1):
    Fatal error: Uncaught TypeError: Argument 2 passed to sum() must be of the type int, string given
    TypeError: Argument 2 passed to sum() must be of the type int, string given, called
sino:
    5 + 4 = 9

Question 10
¿Qué son los estándares PSR?
- Son especificaciones de código basadas en conceptos de programación ya probados cuya intención es proveer interoperabilidad entre componentes. 
- Estas recomendaciones permiten escribir codigo de calidad y mantenimble a largo plazo.
- Facilitan la sustitución de componentes siempre y cuando cumplan las especificaciones.

Question 11
Define un servicio en Symfony llamado foo (utiliza el namespace que quieras para la clase Foo) 
que tenga como dependencia el servicio de Logger de Symfony, y que no se instancie hasta que no se utilice. 

```php
hay que instalar: symfony/proxy-manager-bridge

# config/services.yaml
services:
    App\Services\FooService:
        lazy: true


namespace App\Services;

use Psr\Log\LoggerInterface;

class FooService{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    } 
}

https://stackoverflow.com/questions/63924096/define-a-service-with-lazy-loading-logger-in-symfony
``

Question 12
Define qué es la compiler pass y un ejemplo de para qué se puede utilizar.
- Es una clase que implementa CompilerPassInterface y que permite manipular las configuraciones iniciales de los servicios 
que se han compilado Por ejemplo en varios entornos de despliegue, me intersa que en mis servicios se inyecte siempre otro 
servicio de depuración pero solo si no se está en producción. Para este caso me intersaría inyectar otro servicio similar 
pero que en lugar de lanzara el mensaje por pantalla lo envie a una cola de mensajería.

En este ejemplo se visualiza como inyectar al servicio MailerTransportChain los servicios con tag name app.mail_transport 
llamando a su método addTransport

https://symfony.com/index.php/doc/3.1/service_container/tags.html
Aqui se crearía el compailer pass personalizado: src/AppBundle/DependencyInjection/Compiler/MailTransportPass.php

Question 13
¿Qué problemas tiene el inyectar el container de Symfony como parámetro a una clase de nuestro dominio?
- Se hace un fuerte acoplamiento con la infraestructura y el dominio no debe interactuar directamente por tipo sino por contrato [???]

Question 14
Explica como funciona el late binding en PHP
- El compilador comprueba errores y si no los hay entonces asigna los valores a las variables y ejecuta el programa, 
esto es el early binding.  El late binding en php se hace con static y permite rescribir atributos en una clase estática 
en tiempo de ejecución https://youtu.be/jClyQktD4ow

Question 15
¿Qué es lo que se almacena en aceleradores de caché como OPcache o APC?
- Guardan en bytecode los script pre compilados.
- OPcache mejora el rendimiento de PHP almacenando el código de bytes de un script precompilado en la memoria compartida, 
eliminando así la necesidad de que PHP cargue y analice los script en cada petición.

- APC (antiguo) Su objetivo es el de proporcionar un marco robusto, libre y abierto para optimizar código de PHP intermedio mediante 
el almacenamiento en caché.
</pre>
