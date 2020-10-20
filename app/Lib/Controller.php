<?php
/**
 * Controlador maestro, que hereda el core
 */
class Controller extends Core
{

    public $templatePart;
    public function __construct()
    {

    }
    /**
     * El método vista se encarga de gestionar el frontend de mi aplicación
     * The method is current the frontend of my aplication
     * @param string $vista es el nombre del archivo a incluir en la ejecución
     * @param array $datos Es el arreglo que pasa información del controlador a la vista
     * @param string $nombreModulo es el nombre del modulo que va usar la vista
     */
    public function vista($vista,  $datos = [], $nombreModulo = false)
    {
     
        if (file_exists('../app/Views/' . $vista . '.php')) {
            ob_start('comprimir_html');
            require_once '../app/Views/' . $vista . '.php';
            ob_end_flush();
        } else {
            if (file_exists('../app/Modules/' . $nombreModulo . '/Views/' . $vista . '.php')) {
                ob_start('comprimir_html');
                require_once '../app/Modules/' . $nombreModulo . '/Views/' . $vista . '.php';
                ob_end_flush();
            } else {
                die("La vista no existe.");
            }
        }
       
    }

    /**
     * EL método modelo se encarga de instanciar y retornar el objeto del modelo solicitado
     * The model method is responsible for instantiating and returning the object of the requested model
     * @param string $modelo = contiene el nombre del modelo a llamar
     * @param string $nombreModulo = define el nombre del modulo que va usar su propio modelo
     * @return object $modelo
     */
    public function modelo($modelo, $nombreModulo = false)
    {
        if (file_exists('../app/Models/' . $modelo . '.php')) {
            require_once '../app/Models/' . $modelo . '.php';
            return new  $modelo;
        } else {
            if (file_exists('../app/Modules/' . $nombreModulo . '/Models/' . $modelo . '.php')) {
                require_once '../app/Modules/' . $nombreModulo . '/Models/' . $modelo . '.php';
                return new  $modelo;
            } else {
                die("El modelo no existe.");
            }
        }
    }

    /**
     * EL método pagina404 se encarga de direccionar a la vista 404, de no existir el recurso
     * The page404 method is responsible for directing to view 404, if the resource does not exist
     * @param string $parametro = contiene el parametro
     * @return string 
     */
    public function pagina404($parametro)
    {
        if ($parametro == false) {
            return $this->vista("404");
        }
    }

    /**
     * EL método validadorSesion se encarga de validar que si se alla iniciado la sesion para acceder a los metodos de los controladores
     * The validation method Session is responsible for validating that if the session is initiated to access the controller methods
     */
    public function validadorSesion()
    {
        session_start();
        if (!isset($_SESSION['user_login_status']) &&  $_SESSION['user_login_status'] != 1) {
            redireccionar(''); 
        }
    }

    // Como usarlo:
    /* $excepciones = [
         'celular',
         'nit',
         'edad'
    ];

    if($this->validadorFormulario($_POST)):
    */
    /**
     * EL método validadorFormulario se encarga de validar los campos requeridos en los formularios
     * The validator method Form is responsible for validating the required fields in the forms
     * @param array $array       = contiene los campos del formulario
     * @param array $excepciones = contiene los campos que no se deben validar
     * @return array 
     */
    public function validadorFormulario(array $array, array $excepciones = [])
    {
        if(count($excepciones) > 0){
              //Aplicar excepciones al arreglo, es decir vamos a suprimir los campos indicados
            foreach($excepciones as $i => $var){
                unset($array[$var]);//Suprimi el indice incado en la excepción
            }
    
        }
        $contador = 0;
        foreach ($array as $campo => $valor) {
            if(empty($valor)){
               //echo "El campo {$campo} esta vacio<br>";
               $contador++;
            }
        }

        if($contador == 0){
           return $array;
        }else{
            return false;
        }

    }

    /**
     * filesManager es el método encargado de gestionar y servir los archivos privados
     * @param string $ruta define la ruta del direcorio a usar
     * @param string $nombre nombre del archivo solicitado
     * @param string $type define el tipo de archivo solicitado
    */
    public function filesManager($ruta, $nombre = false, $type, $assets = false)
    {
        switch ($type) {
            case 'img':
              if($nombre != false): 
                header('Content-Type: image/jpg');//Se define la cabecera para el tipo de archivo solicitado
                readfile(RUTA_MODULOS. $ruta.SEPARADOR.$nombre);
              else: 
                header('Content-Type: image/jpg');//Se define la cabecera para el tipo de archivo solicitado
                readfile(RUTA_UPLOAD.SEPARADOR. $ruta);
              endif;
            break;

            case 'js':
                if($assets != false): 
                   /* header('Content-Type: aplication/javascript');
                    readfile()*/
                else:
                    header('Content-Type: aplication/javascript');
                    readfile(RUTA_MODULOS.$ruta.SEPARADOR.$nombre);
                endif;
            break;

            case 'css':
                if($assets != false): 
                   /* header('Content-Type: aplication/javascript');
                    readfile()*/
                else:
                    header('Content-Type: text/css');
                    readfile(RUTA_MODULOS.$ruta.SEPARADOR.$nombre);
                endif;
            break;
        }
    }
}

