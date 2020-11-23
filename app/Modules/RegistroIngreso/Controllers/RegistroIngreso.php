<?php
class RegistroIngreso extends Controller
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
        if (strlen(session_id()) < 1) 
        {
            session_start();
        }
        $datos = [
            'tituloModulo' => 'Registro Ingreso Vehiculos',
            'titulo_vista' => 'Registro Ingreso',
            'listaMarcas'  => $this->objModelo->listadoMarcas(),
            'listaPisos'   => $this->objModelo->listadoPisos($_SESSION['id_parqueadero'])
        ];
        $this->vista('Registro', $datos, $this->nombreModulo);
    }

    // metodo donde se retorna la vista InformeIngresos
    public function InformeIngresos()
    {
        $this->fechaActual =  date('Y-m-d');
        $datos = [
            'tituloModulo' => 'Registro Ingreso Vehículos',
            'titulo_vista' => 'Informe Ingreso Vehículos',
            'fechaFinFiltro' => $this->fechaActual,
            'fechaInicioFiltro' => date("Y-m-d",strtotime($this->fechaActual."- 1 month"))
        ];
        $this->vista('InformeIngresos', $datos, $this->nombreModulo);
    }


    // metodo donde se retorna el json con las datos para listar la tabla de la vista InformeIngresos
    public function ListarInformeIngresos()
    {
        responderJson($this->objModelo->ListarInformeIngresos($_GET));
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

    // función donde se consulta la existencia de un determinado cliente
    public function consultarCliente(int $cedula)
    {
        $this->result  =   $this->objModelo->consultarCliente($cedula);
        if($this->result==false){
            $this->response['res'] = false;
        }else{
            $this->response['res'] = true;
            $this->response['infoCliente'] = $this->result;
        }
        responderJson($this->response);
    } 

    // función donde se registra el parquedo de un determinado vehículo
    public function registroParqueo()
    {
        
        switch ($this->objModelo->registroParqueo($_POST)) {
            case 1:
                $this->cargarArrayResponse(true,"Registro parqueo realizado con exito");
            break;
            case 2:
                $this->cargarArrayResponse(false,"Error, se presento un problema al realizar el registro, por favor intentelo de nuevo");
            break;
            case 3:
                $this->cargarArrayResponse(false,"Error, no se encontro ningún cliente con la cédula digitada");
            break;
        }

        responderJson($this->response);
    }
    
    // metodo donde se carga el array response
    public function cargarArrayResponse(bool $res,string $msg)
    {
        $this->response['res'] = $res;
        $this->response['msg'] = $msg;
    }

}
