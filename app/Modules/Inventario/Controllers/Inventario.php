<?php  

class Inventario extends Controller
{
    public  $nombreModulo;
    private $response = array();
    private $inventarioModelo;

    public function __construct()
    {
        $this->nombreModulo = __CLASS__;//Define el nombre del modulo, obteniendo el nombre de la clase
        $this->validadorSesion();//Define si el nmódulo es privado
        $this->inventarioModelo = $this->modelo('InventarioModelo',$this->nombreModulo);
    }

    public function __destruct()
    {
        $this->response = null;
        $this->inventarioModelo = null;
    }

    public function index()
    {
        $datos = [
            'titulo' => 'Inventario',
        ];

        $this->vista('Inventario', $datos, $this->nombreModulo);
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

    // método para listar el inventario
    public function listar()
    {
        responderJson($this->inventarioModelo->listar());
    }

    // método para insertar en la base de datos
    public function insertar()
    {
        if($this->validadorFormulario($_POST)){
            if($this->inventarioModelo->insertar($_POST)){
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

    // método para traer la información de un determinado producto
    public function traerInfoProducto(int $id)
    {   
        responderJson($this->inventarioModelo->traerInfoProducto($id));
    }   

    // método para editar un determinado producto 
    public function editar(int $id)
    {
        $_POST['id'] = $id;
        if($this->validadorFormulario($_POST)){
            if($this->inventarioModelo->editar($_POST)){
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
