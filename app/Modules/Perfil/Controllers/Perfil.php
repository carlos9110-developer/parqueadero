<?php

class Perfil extends Controller
{
    public  $nombreModulo;
    private $response = array();
    private $perfilModelo;

    public function __construct()
    {
        $this->nombreModulo = __CLASS__;//Define el nombre del modulo, obteniendo el nombre de la clase
        $this->validadorSesion();//Define si el nmódulo es privado
        $this->perfilModelo = $this->modelo('PerfilModelo',$this->nombreModulo);
    }

    public function index()
    {
        $datos = [
            'titulo' => 'Perfil',
        ];

        $this->vista('Perfil', $datos,$this->nombreModulo);
    }

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

    // método donde se trae la información personal del usuario
    public function traerInfo()
    {
        responderJson($this->perfilModelo->traerInfo());
    }

    // método donde se actualizan del usuario que esta en la sesión
    public function actualizarDatos()
    {
        if (strlen(session_id()) < 1) 
        {
            session_start();
        }
        $_POST['id'] = $_SESSION['id_user'];
        if($this->validadorFormulario($_POST)){
            if($this->perfilModelo->actualizarDatos($_POST)){
                $this->response['success'] = true;
            }else {
                $this->response['success'] = false;
                $this->response['caso']    = 2;
            }
        }  else {
            $this->response['success'] = false;
            $this->response['caso']    = 1;
        }
        responderJson($this->response);
    }

    // método donde se actualiza la contraseña
    public function actualizarClave(){
        if (strlen(session_id()) < 1) 
        {
            session_start();
        }
        $_POST['id'] = $_SESSION['id_user'];
        if($this->validadorFormulario($_POST)){
            if($this->perfilModelo->validarContrasenaActual($_POST)){
                if( $_POST['nueva_clave'] == $_POST['nueva_clave_2'] ){
                    if($this->perfilModelo->cambiarContrasena($_POST)){
                        $this->response['success'] = true;
                    }else{
                        $this->response['success'] = false;
                        $this->response['caso']    = 4;
                    }
                }else{
                    $this->response['success'] = false;
                    $this->response['caso']    = 3;
                } 
            } else{
                $this->response['success'] = false;
                $this->response['caso']    = 2;
            }
        }  else {
            $this->response['success'] = false;
            $this->response['caso']    = 1;
        }
        responderJson($this->response);
    }

}   