## Enunciado:
Tienes aproximadamente 120 minutos para completar la prueba, aunque si necesitas más tiempo puedes tomártelo. 
Solo necesitamos que a las 2 horas subas al ftp lo que lleves realizado y prosigas con la prueba.
Cuando la hayas terminado, vuelves a subirla completa al ftp. Por otro lado, tómate la prueba con calma. 
No te agobies si ves que al leer la prueba hay muchas cosas que no sabes hacer. Entendemos que no somos máquinas y que existe espacio para el aprendizaje. 
Como hemos dicho, tómate tu tiempo y haz lo que puedas.
Aquí tienes los datos necesarios para poder realizar las actividades:

### Actividad 1
1o parte: debes crear un fichero llamado actividad_1.php, en él debes crear un formulario con los siguientes campos:
- Un input de tipo "text" con nombre "titulo"
- Un input de tipo "text" con nombre "director" - Un input de tipo "text" con nombre "anio"
- Un campo de tipo "select" con nombre "pais"
Para generar el campo "select" debes usar el fichero "paises.inc", lo encontrarás al acceder al ftp.
El campo "titulo" debe estar relleno para poder enviar el formulario, debes hacer la validación a través de javascript.
2o parte: el fichero actividad_1.php debe recoger los valores de los campos enviadas mediante POST y almacenarlos en la tabla "peliculas", para ello debes:
- Verificar que estás recibiendo variables mediante POST
- Conectarte a la base de datos y crear la sentencia de mysql adecuada para insertar los valores recibidos en la tabla "peliculas"
- Una vez hecha la inserción se debe mostrar de nuevo el formulario vacío pero añadiendo un mensaje, por ejemplo: Los datos se han guardado correctamente.

### Actividad 2
Debes crear un fichero llamado actividad_2.php, este fichero debe ejecutar una búsqueda en la tabla "peliculas" para obtener todos los registros que haya en la tabla, ordenados alfabéticamente por "titulo", e imprimirlos en pantalla de modo que quede algo similar a la siguiente imagen (debes usar algo de estilo para darle formato).

### Actividad 3
Para esta última actividad debes crear un fichero llamado actividad_3.php y debe contener:
- Una clase llamada "Calculadora" que contenga 5 métodos, llamados "sumar", "restar", "multiplicar", "dividir" y "par_impar".
- Los 4 primeros métodos deben recibir 2 parámetros: $numero1 y $numero2 y deben devolver el resultado de la operación.
- El 5o método debe recibir solo un parámetro llamado $numero y debe evaluar si el número es "par" o "impar".
Por ejemplo, si establecemos los valores $numero1 = 10 y $numero2 = 5, al ejecutar el fichero se debería imprimir en la pantalla:
El resultado de ​sumar​ 10 y 5 es ​15.​ 
El resultado de ​restar​ 10 y 5 es ​5​.
El resultado de ​multiplicar​ 10 por 5 es ​50​. 
El resultado de ​dividir​ 10 entre 5 es ​2​.
El número 10 es ​par​ y el número 5 es ​impar​.