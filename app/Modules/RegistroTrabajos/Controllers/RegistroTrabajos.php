<?php
class RegistroTrabajos extends Controller
{
    public  $nombreModulo;
    private $response = array();
    private $registroTrabajosModelo;

    public function __construct()
    {
        $this->nombreModulo = __CLASS__;//Define el nombre del modulo, obteniendo el nombre de la clase
        $this->validadorSesion();//Define si el nmódulo es privado
        $this->registroTrabajosModelo = $this->modelo('RegistroTrabajosModelo',$this->nombreModulo);
    }

    public function __destruct()
    {
        $this->response = null;
        $this->registroTrabajosModelo = null;
    }

    public function index()
    {
        $datos = [
            'titulo' => 'Registro Trabajos',
        ];

        $this->vista('RegistroTrabajos', $datos, $this->nombreModulo);
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

    // método donde se listan lso trabajos realizados
    public function listarTrabajos()
    {
        responderJson($this->registroTrabajosModelo->listarTrabajos());
    }

    // método donde se registran los trabajos realizados
    public function registrarTrabajo()
    {
        $excepciones = ['email_cliente'];   
        if($this->validadorFormulario($_POST,$excepciones)){
            if($this->registroTrabajosModelo->registrarTrabajo($_POST)){
                $this->response['success'] = true;
            }else {
                $this->response['success'] = false;
                $this->response['caso']    = 2;
            }
            responderJson($this->response);
        }  else {
            $this->response['success'] = false;
            $this->response['caso']    = 1;
            responderJson($this->response);
        }
    }

    // método donde se edita un determinado registro
    public function editarRegistroTrabajo(int $id)
    {
        $excepciones = ['email_cliente'];
        $_POST['id'] = $id;   
        if($this->validadorFormulario($_POST,$excepciones)){
            if($this->registroTrabajosModelo->editarRegistroTrabajo($_POST)){
                $this->response['success'] = true;
            }else {
                $this->response['success'] = false;
                $this->response['caso']    = 2;
            }
            responderJson($this->response);
        }  else {
            $this->response['success'] = false;
            $this->response['caso']    = 1;
            responderJson($this->response);
        }
    }

    // método donde se listan los técnicos de la base de datos
    public function traerTecnicos()
    {
        responderJson($this->registroTrabajosModelo->traerTecnicos());
    }

    // método donde se listan los productos utilizados en un determinado trabajo
    public function listarProductosUtilizados(int $id)
    {
        responderJson($this->registroTrabajosModelo->listarProductosUtilizados($id));
    }

    // método donde se trae la información de un determinado registro
    public function traerDatosRegistro(int $id)
    {
        responderJson($this->registroTrabajosModelo->traerDatosRegistro($id));
    }

    // método donde se realiza el registro de la facturación 
    public function registrarFacturacion(int $id)
    {
        $_POST['id'] = $id;   
        if($this->validadorFormulario($_POST)){
            if($this->registroTrabajosModelo->registrarFacturacion($_POST)){
                $this->response['success'] = true;
            }else {
                $this->response['success'] = false;
                $this->response['caso']    = 2;
            }
            responderJson($this->response);
        }  else {
            $this->response['success'] = false;
            $this->response['caso']    = 1;
            responderJson($this->response);
        }
    }

    
}
