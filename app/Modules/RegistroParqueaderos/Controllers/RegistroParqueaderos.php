<?php
class RegistroParqueaderos extends Controller
{
    private  $response;
    private  $objModelo;
    private  $result;
    public   $nombreModulo;
    public function __construct()
    {
        // verifica que el usuario este logueado correctamente y esten definidos la sesiones
        $this->validadorSesion();
        $this->nombreModulo = __CLASS__;
        $this->objModelo = $this->modelo('RegistroParqueaderosModelo',$this->nombreModulo);
        $this->response = array();
    }

    public function __destruct()
    {
        $this->response = null;
    }

    public function index()
    {
        $datos = [
            'titulo_vista' => 'Listado Parqueaderos',
            'titulo' => 'Registro Parqueaderos'
        ];

        $this->vista('Listar', $datos, $this->nombreModulo);
    }

    // metodo donde se retorna la vista para insertar parqueaderos
    public function Insertar()
    {
        $datos = [
            'titulo' => 'Registro Parqueaderos',
            'titulo_vista' => 'Registrar Parqueadero'
        ];
        $this->vista('Insertar', $datos, $this->nombreModulo);
    }


    // metodo donde se insertan los datos de un determinado parqueadero
    public function InsertarForm()
    {
        $excepciones = [
            'logo'
       ];
        if($this->validadorFormulario($_POST,$excepciones)){
            switch ($this->objModelo->InsertarForm($_POST)) {
                case 1:
                    $this->cargarArrayResponse(true,"Registro parqueadero realizado con exito");
                break;
                case 2:
                    $this->cargarArrayResponse(true,"Registro parqueadero realizado con exito, le informamos que el logo no pudo ser registrado por un problema en el servidor, intentelo de nuevo");
                break;
                case 3:
                    $this->cargarArrayResponse(true,"Registro parqueadero realizado con exito, le informamos que el logo no pudo ser registrado por no tener el formato permitido, (.jpg, .png, .jpeg)");
                break;
                case 0:
                    $this->cargarArrayResponse(false,"Error, no fue posible realizar el registro verifique que no exista un registro con el mismo nit");
                break;
            }
        }  else {
            $this->cargarArrayResponse(false,"Error, debe diligenciar correctamente el formulario");
        }
        responderJson($this->response);
    }

    // método donde se retorna la vista para configurar la información de un determinado parqueadero
    public function Editar(int $id)
    {
        $this->response    = $this->objModelo->traerDatos($id);
        $datos = [
            'titulo' => 'Registro Parqueaderos',
            'titulo_vista' => 'Editar Información Parqueadero',
            'infoParqueadero'=>$this->response
        ];
        $this->vista('Editar', $datos, $this->nombreModulo);
    }

    // metodo donde se realiza la edición de los datos de un parqueadero
    public function EditarForm()
    {
        $excepciones = [
            'logo'
       ];
        if($this->validadorFormulario($_POST,$excepciones)){
            switch ($this->objModelo->EditarForm($_POST)) {
                case 1:
                    $this->cargarArrayResponse(true,"Información parqueadero actualizada con exito");
                break;
                case 2:
                    $this->cargarArrayResponse(true,"Información parqueadero actualizada con exito, le informamos que el logo no pudo ser actualizado por un problema en el servidor, intentelo de nuevo");
                break;
                case 3:
                    $this->cargarArrayResponse(true,"Información parqueadero actualizada con exito, le informamos que el logo no pudo ser actualizado por no tener el formato permitido, (.jpg, .png, .jpeg)");
                break;
                case 0:
                    $this->cargarArrayResponse(false,"Error, no fue posible actualizar la información verifique que no exista un parqueadero con el nit diligenciado");
                break;
            }
        }  else {
            $this->cargarArrayResponse(false,"Error, debe diligenciar correctamente el formulario");
        }
        responderJson($this->response);
    }

    // metodo donde se retorna la vista para editar la información de un parqueadero
    public function ConfiguracionPlano(int $id)
    {
        $this->response    = $this->objModelo->traerDatos($id);
        $datos = [
            'titulo' => 'Registro Parqueaderos',
            'titulo_vista' => 'Configuración Planos Parqueadero <b> '.$this->response->nombre.'</b>',
            'infoParqueadero'=>$this->response
        ];
        $this->vista('ConfiguracionPlano', $datos, $this->nombreModulo);
    }

    // método donde se traen los datos de un determinado registro
    public function traerDatos(int $id)
    {
        responderJson($this->registroParqueaderoModelo->traerDatos($id));
    }

    // método donde se retorna la vista para editar los planos de un determinado parqueadero
    public function EditarPlanoParqueadero(int $id)
    {
        $this->response    = $this->objModelo->traerDatosParqueaderoPisos($id);
        $datos = [
            'titulo' => 'Registro Parqueaderos',
            'titulo_vista' => 'Editar Planos Parqueadero <b> '.$this->response['infoParqueadero']->nombre.'</b>',
            'datosParqueadero'=>$this->response['infoParqueadero'],
            'pisosParqueadero'=>$this->response['pisosParqueadero']
        ];
        $this->vista('EditarPlanoParqueadero', $datos, $this->nombreModulo);
    }

    /*
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
    */

    /**
     * EL método listar se encarga de listar los usuarios, realizando paginación del lado del servidor utilizando la clase SSP de datatables
     * The list method is responsible for listing users, paging the server side using the SSP class of datatables
     * @return json con los registros obtenidos 
     */
    
    public function listar()
    {
        responderJson($this->objModelo->listar());
    } 

    /**
     * EL método guardarMatrixPiso se encarga de guardar la matrix de un determinado piso
     * @return json con la la respuesta de la acción
     */
    public function GuardarMatrixPiso()
    {
        responderJson($this->objModelo->GuardarMatrixPiso($_POST));
    } 

     /**
     * EL método EditarMatrixPiso se encarga de editar la matrix de un determinado piso
     * @return json con la la respuesta de la acción
     */
    public function EditarMatrixPiso()
    {
        responderJson($this->objModelo->EditarMatrixPiso($_POST));
    } 
    

    /**
     * EL método traerPisosParqueadero se encarga de traer la información de los pisos de un determinado parqueadero
     * @param int $idParquedero
     * @return json con la la respuesta de la acción
     */
    public function traerPisosParqueadero(int $idParqueadero)
    {
        responderJson($this->objModelo->traerPisosParqueadero($idParqueadero));
    }

    /**
     * EL método traerInfoPiso se encarga de traer la información asociada a un determinado piso de un parqueadero
     * @param int $idPiso
     * @return json con la información asociada al piso
     */
    public function traerInfoPiso(int $idPiso)
    {
        responderJson($this->objModelo->traerInfoPiso($idPiso));
    }

    

    // metodo donde se carga el array response
    public function cargarArrayResponse(bool $res,string $msg)
    {
        $this->response['res'] = $res;
        $this->response['msg'] = $msg;
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
    
}
