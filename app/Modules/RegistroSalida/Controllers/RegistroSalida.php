<?php
class RegistroSalida extends Controller
{
    public   $response;
    private  $objModelo;
    private  $result;
    public   $nombreModulo;
    private  $fechaActual;

    public function __construct()
    {
        // verifica que el usuario este logueado correctamente y esten definidos la sesiones
        $this->validadorSesion();
        $this->nombreModulo  = __CLASS__;
        $this->objModelo     = $this->modelo('RegistroSalidaModelo',$this->nombreModulo);
        $this->response      = array();
    }

    public function __destruct()
    {
        $this->response = null;
    }

    // metodo donde se retorna la vista que contiene la lista de todos los usuarios
    public function index()
    {
        $this->fechaActual =  date('Y-m-d');
        if (strlen(session_id()) < 1) 
        {
            session_start();
        }
        $datos = [
            'tituloModulo' => 'Registro Salida',
            'titulo_vista' => 'Registro Salida Vehículos',
            'fechaFinFiltro' => $this->fechaActual,
            'fechaInicioFiltro' => date("Y-m-d",strtotime($this->fechaActual."- 1 month"))
        ];
        $this->vista('SalidaVehiculos', $datos, $this->nombreModulo);
    }

    // metodo donde se consulta la información para registrar la salid de un determinado vehículo
    public function TraerInfoParaSalida(int $id, string $tipo)
    {
        responderJson($this->objModelo->TraerInfoParaSalida($id, $tipo));
    }

    // métodod donde se retorna el json retornado del modelo con los datos necesarios para cargar el dataTable
    public function listar()
    {
        responderJson($this->objModelo->listar());
    }

    // método donde se realiza se realiza el registro de salida de un determinado vehículo
    public function RegistrarSalidaVehiculo()
    {
        if($this->objModelo->RegistrarSalidaVehiculo($_POST)){
            $this->cargarArrayResponse(true,"Salida vehículo registrada con exito");
        }else{
            $this->cargarArrayResponse(false,"Error, se presento un problema en el servidor, por favor intentelo de nuevo");
        }
        responderJson($this->response);
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

    // metodo donde se carga el array response
    public function cargarArrayResponse(bool $res,string $msg)
    {
        $this->response['res'] = $res;
        $this->response['msg'] = $msg;
    }

}
