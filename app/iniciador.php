<?php
//Incluir configuraciones generales
require_once 'Config/Config.php';
//Zona horaria del sistema
date_default_timezone_set(ZONA_HORARIA);
//Funciones y  ayudantes propios del marco
require_once 'Helpers/Helper.php';

/**
 * Autoload
 * mediante este archivo voy a gestionar la carga dinamica de mis clases, es importante respetar el estandar camelcase
 */
//Cargador automatico de objetos, gracias a estas lineas de codigo no tenemos que requerir los archivos de librerias para realizar herencia
spl_autoload_register(function ($nombreClase) {
    require_once 'Lib/' . $nombreClase . ".php";
});