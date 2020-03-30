He asumido distintas funcionalidades de la api feed.
- La estructura de respuesta
- Los parametros que recibe

En public index.php he creado la implementación del aviso por sms

He incluido la gestion de persistencia en el notificador pero podría haberlo separado en una entidad 

Si bien las claves en persistencia son (fecha y teamid) habría que buscar si existe por teamid que sea anfitrion para que no se dupliquen
registros

La estructura de clases no está probada ya que es un esqueleto genérico