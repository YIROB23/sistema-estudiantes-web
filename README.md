# Sistema de Gestión de Estudiantes

## Descripción

Este proyecto consiste en un sistema web de gestión de estudiantes desarrollado para la asignatura Programación Web II.

La aplicación permite registrar, consultar, editar y eliminar estudiantes mediante una interfaz web conectada a una base de datos MySQL.

## Tecnologías utilizadas

- HTML5
- CSS3
- Bootstrap 5.3.3
- JavaScript
- PHP 8.2 o superior
- MySQL / MariaDB
- XAMPP

## Funcionalidades

- Registro de estudiantes.
- Validación de formularios.
- Consulta dinámica de estudiantes.
- Edición de registros.
- Eliminación de estudiantes.
- Almacenamiento de información en MySQL.

## Requisitos previos

Para ejecutar el proyecto se necesita:

- Tener instalado XAMPP.
- Contar con Apache y MySQL activos.
- Disponer de un navegador web.
- Tener Visual Studio Code (opcional).

## Instalación y ejecución

### 1. Descargar el proyecto

Descargar o clonar el repositorio y colocar la carpeta del proyecto dentro de:

C:\xampp\htdocs\

### 2. Crear la base de datos

1. Iniciar Apache y MySQL desde XAMPP.
2. Ingresar a http://localhost/phpmyadmin/.
3. Crear una base de datos llamada formulario_web.
4. Seleccionar la base de datos.
5. Importar el archivo database/formulario_web.sql.

### 3. Configurar la conexión

Abrir el archivo conexion.php y verificar los parámetros de conexión:

- Servidor: localhost
- Usuario: root
- Contraseña: según la configuración local de MySQL.
- Base de datos: formulario_web.

Si las credenciales de MySQL son diferentes, deben actualizarse en el archivo de conexión.

### 4. Ejecutar el sistema

Abrir el navegador e ingresar a:

http://localhost/formulario/

## Estructura del proyecto

- index.php: formulario de registro de estudiantes.
- conexion.php: conexión con la base de datos.
- procesar.php: procesamiento de los registros.
- listar.php: visualización de estudiantes.
- editar.php: edición de estudiantes.
- eliminar.php: eliminación de registros.
- obtener_estudiantes.php: consulta de estudiantes.
- app.js: funcionalidades y validaciones JavaScript.
- database/: contiene el archivo SQL para crear la estructura de la base de datos.

## Base de datos

El sistema utiliza una base de datos llamada formulario_web, que contiene la tabla usuarios con los siguientes campos:

- id
- nombre
- correo
- telefono
- edad
- programa

El archivo SQL incluido contiene la estructura de la tabla, sin registros personales de estudiantes.

## Seguridad

No se deben publicar contraseñas, credenciales privadas ni información personal de estudiantes reales en el repositorio.

## Autor

Proyecto académico desarrollado para la asignatura Programación Web II.