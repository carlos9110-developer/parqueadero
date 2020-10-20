<?php
class Facturacion extends Controller
{
    public  $nombreModulo;
    private $response = array();
    private $facturacionModelo;

    public function __construct()
    {
        $this->nombreModulo = __CLASS__;//Define el nombre del modulo, obteniendo el nombre de la clase
        $this->validadorSesion();//Define si el nmódulo es privado
        $this->facturacionModelo = $this->modelo('FacturacionModelo',$this->nombreModulo);
    }

    public function __destruct()
    {
        $this->response = null;
        $this->facturacionModelo = null;
    }

    public function index()
    {
        $datos = [
            'titulo' => 'Facturación',
        ];

        $this->vista('Facturacion', $datos, $this->nombreModulo);
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

    // método donde se listan los registros de facturación
    public function listarFacturas()
    {
        responderJson($this->facturacionModelo->listarFacturas());
    }

    // método donde se observa una determinada factura
    public function verFactura(int $id)
    {
        echo $this->facturacionModelo->verFactura($id);
    }

    // método donde se trae la información de un determinado registro
    public function traerDatosRegistro(int $id)
    {
        responderJson($this->facturacionModelo->traerDatosRegistro($id));
    }

    // método donde se edita un determinado registro de facturación
    public function editarFacturacion(int $id)
    {
        $_POST['id'] = $id;  
        if($this->validadorFormulario($_POST)){
            if($this->facturacionModelo->editarFacturacion($_POST)){
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
