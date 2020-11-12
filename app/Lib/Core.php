<?php
class Core
{
    protected $controladorActual = "Login"; //Este es el controlador por defecto
    protected $metodoActual      = "index"; // Este es elll metodo por defecto
    protected $parametros        = [];
    //Constructor
    public function __construct()
    {
        $url = $this->getUrl();
        //print_r($this->getUrl());
        if(isset($url[0])){
            //Buscar en Conttroladores si el controlador llamado existe
            if (file_exists('../app/Controllers/' . ucwords($url[0]) . '.php')) {
                //Si el controlador existe se setea como controlador por defecto, convirtiendo a mayusculas el primer caracter de cada cadena, 
                //por eso se debe utilizar camelCase en el nombre de los archivos y clases de controladores.
                $this->controladorActual = ucwords($url[0]);
                //Unset indice
                unset($url[0]);
            } else {
                //Buscar en Conttroladores si el controlador llamado existe en Plugins
                if (file_exists('../app/Modules/' . ucwords($url[0]) . '/Controllers/' . ucwords($url[0]) . '.php')) {
                    //Si el controlador existe se setea como controlador por defecto
                    $this->controladorActual = ucwords($url[0]);
                    //Unset Indice
                    unset($url[0]);
                }
            }
        }

        
        if (file_exists('../app/Controllers/' . ucwords($this->controladorActual) . '.php')) {
            // Requerir el controlador
            require_once '../app/Controllers/' . ucwords($this->controladorActual) . '.php';
            $this->controladorActual = new $this->controladorActual;
        } else {
            // Requerir el controlador
            require_once '../app/Modules/' . ucwords($this->controladorActual) . '/Controllers/' . ucwords($this->controladorActual) . '.php';
            $this->controladorActual = new $this->controladorActual;

        }
        //Chequera la segunda parte de la url, el método la acción
        if (isset($url[1])) {
            if (method_exists($this->controladorActual, $url[1])) {
                //Chequeamos el método
                $this->metodoActual = $url[1];
                unset($url[1]);// destruye la posición del array
            }
        }
        //Para probar traer método
        //echo $this->metodoActual;
        //Obtener parametros, como ya se han borrado las posiciones del arreglo si todavia quedan valores esos son los parametros, por lo tanto los asignamos a nuestra variable en un array indexado
        $this->parametros = $url ? array_values($url) : [];
        //llamar Callback con parametros Array, se llama la acción a realizar, como parametros se envia la clase instanciada, el método y los parametros
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);// llama a la funci
    }

    //Función para gestionar las Url,s
    public function getUrl()
    {
        //echo $_GET['url'];
        if (isset($_GET['url'])) {
            //Limpiamos los espacios que estan a la derecha de la url
            $url = rtrim($_GET['url'], '/');
            // limpia nuesta url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // genera un array, donde cada que encuentra / se hace una nueva posición del array, el array queda de minimo una posición y maximo tres
            $url = explode('/', $url);
            return $url;
        }
    }
}