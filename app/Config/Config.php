<?php

//VARIABLES CONSTANTES
//Bases de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'parqueadero');
define('DB_DRIVER', 'mysql');

//  INFORMACIÓN AUTOR
define('INFO_AUTOR', 'Todos los derechos reservados');
//RUTA URL DE LA APLICACIÓN
define('RUTA_URL', 'http://localhost:8080/parqueadero'); // este se cambiaria en el servidor
//NOMBRE DE LA APLICACIÖN
define('NOMBRE_APP', 'Auto Express');
//RUTA DE LA APLICACION
define('RUTA_APP',  dirname(dirname(__FILE__)));// toma la ruta de la carpeta app,  C:\xampp\htdocs\adminsoft\app
//ZONA HORARIA
define('ZONA_HORARIA', 'America/Bogota');
//SEPADOR DE DIRECTORIOS
define('SEPARADOR', DIRECTORY_SEPARATOR);// para dar compatibilidad en la navegación de archivos en linux y windows
//RUTA MODULOS
define('RUTA_MODULOS', RUTA_APP . SEPARADOR . 'Modules' . SEPARADOR);// ruta para los modulos de nuestra aplicación
//RUTA UPLOAD
define('RUTA_UPLOAD', RUTA_APP . SEPARADOR . 'Upload'.SEPARADOR);// ruta para los archivos
//  RUTA DEL LOGO
define('RUTA_LOGO', 'http://localhost:8080/parqueadero/public/img/logo.jpeg'); // este se cambiaria en el servidor:8080

//  VERSIÓN
define('VERSION', '2.1');