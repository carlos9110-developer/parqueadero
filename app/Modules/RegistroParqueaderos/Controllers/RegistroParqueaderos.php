<?php

class RegistroParqueaderos extends Controller
{
    private  $response;
    private  $registroParqueaderoModelo;
    private  $result;
    public   $nombreModulo;
    public function __construct()
    {
        // verifica que el usuario este logueado correctamente y esten definidos la sesiones
        $this->validadorSesion();
        $this->nombreModulo = __CLASS__;
        $this->registroParqueaderoModelo = $this->modelo('RegistroParqueaderosModelo',$this->nombreModulo);
        $this->response = array();
    }

    public function __destruct()
    {
        $this->response = null;
    }

    public function index()
    {
        $datos = [
            'titulo' => 'Registro Parqueaderos',
        ];

        $this->vista('RegistroParqueaderos', $datos, $this->nombreModulo);
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

    public function insertar()
    {
        $excepciones = [
            'logo'
       ];
        if($this->validadorFormulario($_POST,$excepciones)){
            responderJson($this->registroParqueaderoModelo->insertar($_POST));
        }  else {
            $this->response['success'] = false;
            $this->response['msg']     = "Error, faltaron campos por diligenciar";
            responderJson($this->response);
        } 
    }

    // método donde se traen los datos de un determinado registro
    public function traerDatos(int $id)
    {
        responderJson($this->registroParqueaderoModelo->traerDatos($id));
    }

    // método donde se edita la información de un determinado usuario
    public function editar(int $id)
    {
        $_POST['id'] = $id;
        if($this->validadorFormulario($_POST)){
            if($this->registroParqueaderoModelo->editar($_POST)){
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

    /**
     * EL método listar se encarga de listar los usuarios, realizando paginación del lado del servidor utilizando la clase SSP de datatables
     * The list method is responsible for listing users, paging the server side using the SSP class of datatables
     * @return json con los registros obtenidos 
     */
    public function listar()
    {
        responderJson($this->registroParqueaderoModelo->listar());
    }  


    /**
     * EL método guardarMatrixPiso se encarga de guardar la matrix de un determinado piso
     * @return json con la la respuesta de la acción
     */
    public function guardarMatrixPiso()
    {
        responderJson($this->registroParqueaderoModelo->guardarMatrixPiso($_POST));
    } 
    

    /**
     * EL método traerPisosParqueadero se encarga de traer la información de los pisos de un determinado parqueadero
     * @param int $idParquedero
     * @return json con la la respuesta de la acción
     */
    public function traerPisosParqueadero(int $idParqueadero)
    {
        responderJson($this->registroParqueaderoModelo->traerPisosParqueadero($idParqueadero));
    }

    /**
     * EL método traerInfoPiso se encarga de traer la información asociada a un determinado piso de un parqueadero
     * @param int $idPiso
     * @return json con la información asociada al piso
     */
    public function traerInfoPiso(int $idPiso)
    {
        responderJson($this->registroParqueaderoModelo->traerInfoPiso($idPiso));
    }

    
    
     /**
     * EL método guardarMatrixPisoEditar se encarga de editar la matrix de un determinado piso
     * @return json con la la respuesta de la acción
     */
    public function guardarMatrixPisoEditar(int $idPiso)
    {
        $_POST['idPiso'] = $idPiso;
        responderJson($this->registroParqueaderoModelo->guardarMatrixPisoEditar($_POST));
    } 
    
}
