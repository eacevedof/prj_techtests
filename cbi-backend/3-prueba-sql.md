-----------------------------------------------------
### Pregunta 1:  ---
-----------------------------------------------------
Dada la siguiente tabla:

```sql
CREATE TABLE `IMPUTACION` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Codigo_empleado` bigint(20) unsigned DEFAULT NULL,
  `Actividad` bigint(20) unsigned DEFAULT,
  `Horas` decimal(50,14) DEFAULT NULL,
  `Shared_id` varchar(128) NOT NULL, 

  PRIMARY KEY (`ID`),

  KEY `Codigo_empleado_index` (`Codigo_empleado`),
  KEY `Actividad_index` (`Actividad`),
  KEY `Shared_id_index` (`Shared_id`),
  KEY `Emp_act_index` (`Codigo_empleado`, `Actividad`),
  KEY `Emp_act_qc_index` (`Codigo_empleado`, `Actividad`, `Quincena`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

```

En el hipotetico caso de tener una aplicación que trata datos relativos a empleados.
Teniendo en cuenta lo siguiente:

- La app se integra con otra app externa que gestiona la imputación de horas de
esos empleados.
- A traves de una api recive los datos de las imputaciones de los empleados.
- La tabla de imputación contiene los datos de las horas que han invertido los
empleados en las distintas actividades / proyectos / tareas de la empresa.
- A traves de la api llegan importaciones masivas de datos, tanto añadidos como
actualizaciones, y los sistemas no comparten los mismos IDs (para la tabla de 
imputaciones) por lo que cuando se diseñó la integración se decidió usar un código
generado de hasta 128 caracteres que es único y corresponde al empleado, fecha y
actividad. **Este campo sería Shared_id en la tabla anteriormente descrita.**
- Cuando se reciben datos se buscan los Shared_id y los registros que ya existen
son actualizados mientras que el resto son añadidos.

Teniendo esto en mente, un día se descubre que hay un error en el código que se
encarga de la inserción / actualización de datos. Este error está provocando que
haya registros duplicados con el mismo Shared_id en la tabla de imputación,
incluso algunos casos en los que el número de horas no coincide. El error es
subsanado a nivel código pero ahora tenemos que limpiar la tabla de imputación.
Para ello es necesario tener en cuenta que debemos borrar los duplicados dejando
solo el último registro, el cual se supone que contiene los datos válidos.

Diseña una consulta que borre solo los datos que son erroneos. Adicionalmente,
¿Crees que la tabla tiene algún error de diseño?. De ser así, ¿Cómo la mejorarías?

DELETE i.*
FROM IMPUTACION i
INNER JOIN 
(
    SELECT Shared_id
    FROM IMPTUACION
    WHERE 1
    GROUP BY Shared_id
    HAVIGN COUNT(ID)>1
) repetidos
ON i.Shared_id = repetidos.Shared_id
WHERE 1
AND i.ID NOT IN (
    -- de los repetidos anteriores que se excluyan los últimos
    SELECT MAX(ID) maxid
    FROM IMPTUACION
    WHERE 1
    GROUP BY Shared_id
    HAVIGN COUNT(ID)>1
)

Le falta el campo quincena, cambiaria las clave a clave multiple: Codigo_empleado, Quincena y Actividad

-----------------------------------------------------
### Pregunta 2: ---
----------------------------:-------------------------
Dada la siguiente consulta
    
```sql
SELECT
    distinct(`TABLE_B`.`field_4780`)  AS  `country`,
    `TABLE_A`.`field_4302`  AS `entity_name`,
    ( Round(Sum(`TABLE_C`.`field_3877`), 0) ) AS `amount`, 
    ( Round(Sum(`TABLE_C`.`field_3881`), 0) ) AS `budget_deviation_amount`,
    ( Round(Sum(`TABLE_C`.`field_3878`), 0) ) AS `budget_amount`,
    `TABLE_E`.`TEXT_FIELD_E` AS `Description`
FROM  `TABLE_C` 
    INNER JOIN `TABLE_F` ON `TABLE_C`.`field_3874` = `TABLE_F`.`id` 
    INNER JOIN `TABLE_D` ON `TABLE_C`.`field_3873` = `TABLE_D`.`id` 
    INNER JOIN `TABLE_E` ON `TABLE_F`.`id` = `TABLE_E`.`field_4024` 
    LEFT JOIN `TABLE_G` ON (
        `TABLE_E`.`field_4033` = `TABLE_G`.`id` AND
        `TABLE_E`.`field_4034` = `TABLE_G`.`field_4015` AND
        `TABLE_E`.`TEXT_FIELD_E` = `TABLE_G`.`TEXT_FIELD_G`
    )
    INNER JOIN `TABLE_H` ON `TABLE_D`.`id` = `TABLE_H`.`field_4785` 
    INNER JOIN `TABLE_A` ON `TABLE_D`.`id` = `TABLE_A`.`field_4052`
    INNER JOIN `TABLE_B` ON `TABLE_H`.`field_4786` = `TABLE_B`.`id` 
WHERE 
    (
        UPPER(`TABLE_A`.`field_4302`) = 'ENTITY' OR
        `TABLE_B`.`field_4302` like 'SECONDARY%'
    ) AND
    `TABLE_A`.`field_4307` = 1 

GROUP  BY
    `TABLE_E`.`field_4033`, 
	`TABLE_G`.`field_4019`

ORDER  BY `TABLE_A`.`field_4302` ASC 
LIMIT  1000;
```

Describe brevemente, como optimizarías la consulta, que cosas consideras que
deberían cambiarse y que indices añadirías a las tablas que intervienen en la
misma (si consideras que habría que añadir alguno).

Crearia subconsultas anidadas antes de hacer los join recuperando los campos implicados, es decir
en lugar de hacer INNER JOIN TABLA_A.field_x = TABLA_B.field_y analizaria que campos se usan de A y de B convirtiendo el join a este tipo:

SELECT ta.<campos>,tb.<campos>
FROM
(
    SELECT <campos que se usan>
    FROM TABLA_A
) ta
INNER JOIN 
(
    SELECT <campos que se usan>
    FROM TABLA_B
) tb
ON ta.field_x = TABLA_B.field_y

De estos campos implicados, recuperaria solo campos claves para finalmente hacer el cruce con sus tablas de dimensiones extrayendo los datos faltantes.
En un ejemplo similar: si tengo pais, provincia, ciudad. Haría una query: 

SELECT pais,provincia,ciudad
FROM
(
    -- en esta subconsulta se ha acotado el resultado
    SELECT id_pais, id_provincia, id_ciudad
    FROM tabla
    JOINS ..
    WHERE ...
) soloindices
LEFT JOIN pais
ON soloindices.id_pais = pais.id
LEFT JOIN provincia
ON soloindices.id_provincia = provincia.id
LEFT JOIN ciudad
ON soloindices.id_ciudad = ciudad.id


por otro lado configuraría estos indices.
TABLE_C (3873,3874)
TABLE_E (4024), (4033,4034,TEXT_FIELD_E)
TABLE_H (4785), (4786)
TABLE_G (id, 4015, TEXT_FIELD_G)
TABLE_A (4052),(4302,4307)
TABLE_B (4302)
