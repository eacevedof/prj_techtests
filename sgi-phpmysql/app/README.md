- Se tiene una aplicación web que permite listar, crear y editar los productos de una base de datos (BD_Productos). 
- **No se permite realizar ningún almacenamiento en disco.**

##Los requisitos de la aplicación son:
#### Validaciones:
- Nombre: máximo 160 caracteres en UTF‐8 ✅
- Descripción: máximo 258 caracteres en UTF‐8 ✅
- Imagen en formato .jpg o .png ✅
- La url del producto  es: http://localhost/productos/{id_producto}
- Se permite la exportación a un fichero XML de todos los productos con todos sus datos ✅

### Datos de acceso BD:
```
Host: localhost
User: root
Pass: (vacía)
Acceso al código desplegado:
DocumentRoot: C:\xampp\htdocs
```

### Se solicita:

- Corregir todos los errores para que se cumplan los requisitos indicados en la prueba ✅
- Arreglar todos los errores que se encuentren en el código (detallar todos los errores detectados y corregirlos)  ✅
- Completar el método para exportar a xml (exportXML()) ✅
- Añadir las validaciones de los campos de Producto (validate()) ✅

### Añadir las siguientes funcionalidades nuevas:
- Permitir crear categorías con nombre y descripción (vista con listado de categorías, crear, editar y eliminar categorías)
- Añadir categoría a los productos (se permite seleccionar de entre las categorías existentes)
- Permitir exportar un único producto a xml  ✅
- Añadir confirmación al eliminar un producto ✅
- Hacer que la imagen no sea obligatoria y permitir eliminar la imagen de un producto ya existente ✅
