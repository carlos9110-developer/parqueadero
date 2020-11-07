<?php

class RegistroIngreso extends Controller
{
    public   $response;
    private  $objModelo;
    private  $result;
    public   $nombreModulo;

    public function __construct()
    {
        // verifica que el usuario este logueado correctamente y esten definidos la sesiones
        $this->validadorSesion();
        $this->nombreModulo  = __CLASS__;
        $this->objModelo     = $this->modelo('RegistroIngresoModelo',$this->nombreModulo);
        $this->response      = array();
    }

    

    public function __destruct()
    {
        $this->response = null;
    }

    // metodo donde se retorna la vista que contiene la lista de todos los usuarios
    public function index()
    {

        $datos = [
            'titulo_vista' => 'Registro Ingreso'
        ];

        $this->vista('Registro', $datos, $this->nombreModulo);
    }

    // metodo que retorna un archivo vinculado en la vista, sea un archivo css o un javascript
    public function files()
    {
        if(isset($_GET['img']) || isset($_GET['js']) || isset($_GET['css']) || isset($_GET['pdf'])){
            if(isset($_GET['img'])){
                 return $this->filesManager($_GET['img'], false, 'img');
            }
            if(isset($_GET['js'])){
                return $this->filesManager($this->nombreModulo, $_GET['js'], 'js');
            }
            if(isset($_GET['css'])){
                return $this->filesManager($this->nombreModulo, $_GET['css'], 'css');
            }
            if(isset($_GET['pdf'])){

            }
        }else{
            exit('Método no disponible');

        }
    }
    
}
