<?php  

class EntradaProductos extends Controller
{
    public  $nombreModulo;
    private $response = array();
    private $entradaProductosModelo;

    public function __construct()
    {
        $this->nombreModulo = __CLASS__;//Define el nombre del modulo, obteniendo el nombre de la clase
        $this->validadorSesion();//Define si el nmódulo es privado
        $this->entradaProductosModelo = $this->modelo('EntradaProductosModelo',$this->nombreModulo);
    }

    public function __destruct()
    {
        $this->response = null;
        $this->entradaProductosModelo = null;
    }

    public function index()
    {
        $datos = [
            'titulo' => 'Entrada Productos',
        ];

        $this->vista('EntradaProductos', $datos, $this->nombreModulo);
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

    // método donde se listan las entradas de productos
    public function listarEntradas()
    {
        responderJson($this->entradaProductosModelo->listarEntradas());
    }

    // método donde se registra la entrada de productos
    public function registrarEntrada()
    {
        if($this->validadorFormulario($_POST)){
            if($this->entradaProductosModelo->registrarEntrada($_POST)){
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

    // método donde se listan los productos de una determinada entrada
    public function listarProductosEntrada(int $id)
    {
        responderJson($this->entradaProductosModelo->listarProductosEntrada($id)); 
    }

    // método donde se trae la información de un determinado registro
    public function traerDatosRegistro(int $id)
    {
        responderJson($this->entradaProductosModelo->traerDatosRegistro($id));
    }

    // método donde se edita un determinado registro
    public function editarRegistro(int $id)
    {
        $excepciones = ['input_total_compra'];
        $_POST['id'] = $id;
        if($this->validadorFormulario($_POST,$excepciones)){
            if($this->entradaProductosModelo->editarRegistro($_POST)){
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
